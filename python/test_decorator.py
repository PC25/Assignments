import unittest
from decorator import checkUser

class testCheckUser(unittest.TestCase):
    def test_checkUser(self):
        self.assertRaises(Exception,checkUser,4)
        self.assertRaises(Exception,checkUser,['asdff',4])
        self.assertRaises(Exception,checkUser,"ritvik/jian")
        self.assertRaises(Exception,checkUser,3+5j)