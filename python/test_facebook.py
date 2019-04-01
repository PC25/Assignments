import unittest
from facebook import scrape

class testScrape(unittest.TestCase):
    def test_scrape(self):
        self.assertRaises(Exception,scrape,4)
        self.assertRaises(Exception,scrape,['asdff',4])
        self.assertRaises(Exception,scrape,"ritvik/jian")
        self.assertRaises(Exception,scrape,3+5j)
        self.assertRaises(Exception,scrape,"ritid&(jain")