#import "ICGame.h"
#import "ICCountry.h"
#import "ICComputerPlayer.h"

@implementation ICComputerPlayer
/**" ICComputerPlayer is an abstract superclass of all computer players. It contains a number of convenience methods to simplify the design of computer players.  "**/

- (id) initWithCoder: (NSCoder *) coder {
    [super initWithCoder: coder];
    [self setAttackers: [coder decodeObject]];
    [self setVictims: [coder decodeObject]];
    return self;
}

- (void) encodeWithCoder: (NSCoder *) coder {
    [super encodeWithCoder: coder];
    [coder encodeObject: attackers];
    [coder encodeObject: victims];
}

// Identifies this class and its subclasses as being computer players.
- (BOOL) isComputer {
    return YES;
}

/*" Checks to see if there are sets of cards that can be turned in. If so, turns them in. This method can be called by #assignArmiesFromIncome. "*/
- (void) turnInCardsIfPossible {
    NSArray *bestCards = [self bestCardsToTurnIn];
    if ([bestCards count])
	[self turnInCards: bestCards];
}

/*" Called when the player must turn in cards. By default, turns in the best cards possible. "*/
- (void) pickCardsToTurnIn {
    [self turnInCards: [self bestCardsToTurnIn]];
}

/*" Randomly places armies in the destination countries. "*/
- (void) allocateArmiesRandomly {
    while (unallocatedArmies > 0) 
	[(ICCountry *) [destinationCountries randomObject] assignArmies: [gameController takeSelectedArmies]];
}

/*" Places armies in the most threatened destination countries.
  While there are unallocated armies, places an army in the most threatened country.
 The threat level is defined as the number of adjacent enemy armies minus the number of armies.  "*/
- (void) allocateArmiesToMostThreatenedCountries {
    if ([[self countries] count] > 0 && ![game isVictory]) { 
	while (unallocatedArmies > 0) {
	    int selectedArmies = [gameController takeSelectedArmies];
	    [destinationCountries makeObjectsPerformSelector: @selector(calculateThreat)];
	    [destinationCountries sortUsingSelector: @selector(sortByThreat:)];
	    [[destinationCountries lastObject] assignArmies: selectedArmies];
	}
    } else {
	NSLog(@"Not placing armies because countries count is %@", countries);
    }
}

/*" Same as #allocateArmiesToMostThreatenedCountries, except distributes armies a little more evenly and less predictably. 
 Specifically, most armies are placed in the most threatened few countries, while a few armies are randomly distributed among the other countries. "*/
- (void) allocateArmiesRandomlyToMostThreatenedCountries {
    if ([countries count] > 0 && ![game isVictory]) {
	while (unallocatedArmies > 0) {
	    [destinationCountries makeObjectsPerformSelector: @selector(calculateThreat)];
	    [destinationCountries sortUsingSelector: @selector(sortByThreat:)];
	    [[destinationCountries randomObjectTowardsEnd] assignArmies: [gameController takeSelectedArmies]];
	}
    }
}

/*" For each victim country, while there are unallocated armies, places enough armies in the country that will be used to attack the victim to have a good chance of counquering the victim. "*/
- (void) allocateArmiesToAttackers {
    int i;
    for (i = 0; i < [victims count]; i++) {
	ICCountry *victimCountry = [victims objectAtIndex: i];
	ICCountry *attackerCountry = [[victimCountry attackPath] objectAtIndex: 0];
	float targetArmies = [victimCountry armiesAlongAttackPath] + 10;
	while ([attackerCountry armies] < targetArmies && unallocatedArmies > 0)
	    [attackerCountry assignArmies: [gameController takeSelectedArmies]];
    }
}

/*" Sets aside a certain portion of armies in each of the player's countries to use for defense. These armies will not be used when attacking. The portion used for defense is determined by the value returned by #armiesToReserveForDefense."*/
- (void) updateReserveArmies {
    int i;
    for (i = 0; i < [countries count]; i++) {
	ICCountry *country = [countries objectAtIndex: i];
	[country setReserveArmies: [country armies] * [self armiesToReserveForDefense]];
    }
}

/*" Tells each of the player's countries to attack their most vulnerable neighbors. Returns !{NO} if the player conquers a country. Returns !{YES} if there are not enough armies to continue attacking. "*/
- (BOOL) attackVulnerableCountries {
    int i;
    for (i = 0; i < [countries count]; i++) {
	ICCountry *country = [countries objectAtIndex: i];
	ICCountry *target = [country mostVulnerableNeighbor];
	if (target != nil && [country armies] > [country reserveArmies]) {
	    int attackCount = [country armies]; // kludge to avoid an infinite loop
	    BOOL won = NO;
	    
	    // while the player hasn't expended all their armies or won
	    while ([country armies] > [country reserveArmies] && 
		   attackCount > 0 && !won && ![game isVictory]) {
		if (![country selected]) [game setCurrentCountry: country];
		
		if ([country attack: target 
		    attacksPerClick: AttackOnce
		    untilLossesExceed: 100 // this value isn't used
		    withDice: 2
		    advanceArmies: NO]) 
		    won = YES;
		attackCount--;
	    } 
	    
	    if (won) {
		[game setCurrentCountry: nil];
		return NO; // player not done, but view should update
	    }
	}
    }
    
    return YES; // player is done attacking
}

/*" Tells each of the player's countries to randomly attack their neighbors. Returns !{NO} if the player conquers a country. Returns !{YES} if there are not enough armies to continue attacking. "*/
- (BOOL) attackRandomCountries {
    int i;
    for (i = 0; i < [countries count]; i++) {
	ICCountry *country = [countries objectAtIndex: i];
	ICCountry *target = (ICCountry *) [[country unownedNeighbors] randomObject];
	if (target != nil && [country armies] > [country reserveArmies]) {
	    int attackCount = [country armies]; // kludge to avoid an infinite loop
	    BOOL won = NO;
	    
	    // while the player hasn't expended all their armies or won
	    while ([country armies] > [country reserveArmies] && 
		   attackCount > 0 && !won && ![game isVictory]) {
		if (![country selected]) [game setCurrentCountry: country];
		
		if ([country attack: target 
		    attacksPerClick: AttackOnce
		    untilLossesExceed: 100 // this value isn't used
		    withDice: 2
		    advanceArmies: NO])
		    won = YES;
		attackCount--;
	    } 
	    
	    if (won) {
		[game setCurrentCountry: nil];
		return NO; // player not done, but view should update
	    }
	}
    }
    
    return YES; // player is done attacking
}

/*" Tries to attack each country in the %victims array. "*/
- (BOOL) attackVictimsWithAttackers {
    int i;
    
    for (i = 0; i < [victims count]; i++) {
	ICCountry *goal = [victims objectAtIndex: i];
	NSArray *attackPath = [goal attackPath];
	int attackerIndex = [goal indexOfLastCountryOnAttackPathOwnedBy: self];
	if (attackerIndex > -1) {
	    ICCountry *attackerCountry = [attackPath objectAtIndex: attackerIndex];
	    ICCountry *victimCountry = [attackPath objectAtIndex: attackerIndex + 1];
	    BOOL won = [attackerCountry attack: victimCountry 
		attacksPerClick: AttackUntilWinOrLose
		untilLossesExceed: 100 // this value isn't used
		withDice: 2
		advanceArmies: NO];
	    if (won) {
		[game setCurrentCountry: nil];
		[[self victims] removeObject: victimCountry];
		if ([[self victims] count] == 0 && ![game isVictory]) {
		    [self pickAttackersAndVictims];
		}
		return NO;
	    }
	}
    }

    return YES;
}

/*" The portion of armies to reserve for defense. If this method returns 0.0, all armies will be used for attacking. If it returns 1.0, no armies will be used for attacking. "*/
- (float) armiesToReserveForDefense {
    return 0.5;
} 

/*" Sends the #fortifyArmiesFrom: message to all countries with armies that can be moved. "*/
- (void) fortifyVulnerableCountries {
    int i;
    for (i = 0; i < [countries count]; i++) {
	ICCountry *country = [countries objectAtIndex: i];
	NSMutableArray *friends = [country ownedNeighbors];
	[friends addObject: country];
	if ([friends count] > 1 && [country armies] > 0 && [country armies] > [country tiredArmies]) {
	    [game setCurrentCountry: country];
	    [self fortifyArmiesFrom: country];
	}
    }
}

/*" Override this method to pick attackers and victims. You should call this method before placing armies at the beginning of hte turn. It will also be called by #attackVictimsWithAttackers if all the victims have been conquered. "*/
- (void) pickAttackersAndVictims {

}

/*" Calculates attack paths for all countries. After calling this method, every unowned country will have its %attackPath array set to the countries along the optimum attack path from an owned country. "*/
- (void) calculateAttackPaths {
    [[game countries] makeObjectsPerformSelector: @selector(resetAttackPath)];
    [[self countries] makeObjectsPerformSelector: @selector(calculateAttackPath)];
}

/*" The countries you would like to attack from. "*/
- (NSMutableArray *) attackers {
    return attackers;
}

/*" Sets the countries you would like to attack from. You may call this method from your implementation of #pickAttackersAndVictims. When attacking using #attackVictimsWithAttackers, attacks are actually launched from the first country in each country's %attackPath. "*/
- (void) setAttackers: (NSMutableArray *) value {
    [value retain];
    [attackers release];
    attackers = value;
}

/*" The countries you would like to attack. The method #attackVictimsWithAttackers will try to attack the countries in victims. "*/
- (NSMutableArray *) victims {
    return victims;
}

/*" Sets the countries you would like to attack. You should call this method from your implementation of #pickAttackersAndVictims. "*/
- (void) setVictims: (NSMutableArray *) value {
    [value retain];
    [victims release];
    victims = value;
    [victims sortUsingSelector: @selector(sortByArmiesAlongAttackPath:)];
}


- (void) dealloc {
    [attackers release];
    [victims release];
    [super dealloc];
}

@end
