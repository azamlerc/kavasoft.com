#!/usr/bin/env python3
"""HTTP smoke checks against a running Docker image. Uses Python's standard library."""
import concurrent.futures
import sys
import urllib.error
import urllib.request

CASES = [('', 200, 'All rights reserved.'), ('downloads/', 200, 'All rights reserved.'), ('press/', 200, 'All rights reserved.'), ('contact/', 200, 'All rights reserved.'), ('HyperImage/webmasters/', 200, 'All rights reserved.'), ('Shoebox/download/', 200, '</html>'), ('Shoebox/download/cameras.php', 200, '</html>'), ('Shoebox/download/phpsupport.php', 200, 'What is PHP?'), ('Shoebox/tour/onepage.php', 200, '</html>'), ('iConquer/developer/', 200, 'All rights reserved.'), ('iConquer/plugins/', 200, 'All rights reserved.'), ('Shoebox/categories/', 200, '</html>'), ('Curator/', 200, 'All rights reserved.'), ('Curator/version.php', 200, '</plist>'), ('Curator/tour/', 200, 'All rights reserved.'), ('Curator/tour/?page=9999', 200, 'All rights reserved.'), ('HyperImage/', 200, 'All rights reserved.'), ('HyperImage/version.php', 200, '</plist>'), ('HyperImage/tour/', 200, 'All rights reserved.'), ('HyperImage/tour/?page=9999', 200, 'All rights reserved.'), ('KavaMovies/', 200, 'All rights reserved.'), ('KavaMovies/version.php', 200, '</plist>'), ('KavaMovies/tour/', 200, 'All rights reserved.'), ('KavaMovies/tour/?page=9999', 200, 'All rights reserved.'), ('KavaServices/', 200, 'All rights reserved.'), ('KavaServices/version.php', 200, '</plist>'), ('KavaServices/tour/', 200, 'All rights reserved.'), ('KavaServices/tour/?page=9999', 200, 'All rights reserved.'), ('KavaTunes/', 200, 'All rights reserved.'), ('KavaTunes/version.php', 200, '</plist>'), ('KavaTunes/tour/', 200, 'All rights reserved.'), ('KavaTunes/tour/?page=9999', 200, 'All rights reserved.'), ('Shoebox/', 200, 'All rights reserved.'), ('Shoebox/version.php', 200, '</plist>'), ('Shoebox/tour/', 200, 'All rights reserved.'), ('Shoebox/tour/?page=9999', 200, 'All rights reserved.'), ('iConquer/', 200, 'All rights reserved.'), ('iConquer/version.php', 200, '</plist>'), ('iConquer/tour/', 200, 'All rights reserved.'), ('iConquer/tour/?page=9999', 200, 'All rights reserved.'), ('Curator/faq/', 200, 'All rights reserved.'), ('Curator/faq/help.php', 200, '</html>'), ('HyperImage/faq/', 200, 'All rights reserved.'), ('HyperImage/faq/help.php', 200, '</html>'), ('KavaTunes/faq/', 200, 'All rights reserved.'), ('KavaTunes/faq/help.php', 200, '</html>'), ('Shoebox/faq/', 200, 'All rights reserved.'), ('Shoebox/faq/help.php', 200, '</html>'), ('store/', 410, 'services'), ('store/orders.php', 410, 'services'), ('store/authorize', 410, 'services'), ('licenses/lookup.php', 410, 'services'), ('versions/', 410, 'services'), ('press/thanks.php', 410, 'services'), ('info.php', 410, 'services'), ('iConquer/imageflow/reflect2.php?img=example.jpg', 410, 'services'), ('Curator/?coupon[]=1', 400, 'Invalid query'), ('Curator/tour/?page=invalid', 400, 'Invalid page')]
BASE = (sys.argv[1] if len(sys.argv) > 1 else 'http://127.0.0.1:8080').rstrip('/')

def check(case):
    path, expected_status, expected_text = case
    try:
        response = urllib.request.urlopen(BASE + '/' + path, timeout=90)
    except urllib.error.HTTPError as error:
        response = error
    with response:
        body = response.read().decode('utf-8', 'replace')
        assert response.status == expected_status, (path, response.status, expected_status)
        assert expected_text.lower() in body.lower(), (path, 'incomplete page')
        assert not any(marker in body for marker in ('<b>Fatal error</b>', '<b>Warning</b>', '<b>Deprecated</b>')), path
    return path

with concurrent.futures.ThreadPoolExecutor(max_workers=4) as pool:
    results = list(pool.map(check, CASES))
print(f'{len(results)} HTTP checks passed.')
