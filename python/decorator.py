import mysql.connector as mc
import re

def throw_exception(func):
    def wrapper(arg1):
        print(type(arg1).__name__ )
        if (type(arg1).__name__ !='str'):
            raise ValueError("Value not compatible")
        if len(re.split(r"[/_{}'/%^&*@#! ]",arg1))>1 :
            raise Exception("Invalid username")

        try:
            if not(func(arg1)):
                raise Exception("This user is non-existent")
        except Exception as Argument:
            print(f"Error ocurred:{Argument}")
        else:
            print("Yeah user is there!!")

    return wrapper





@throw_exception
def checkUser(username):
  
    thisdb = mc.connect(
    host="localhost",
    user="ritvik",
    password="kundalmapur",
    database="project"
    )
    cursor=thisdb.cursor()
    cursor.execute(f"select * from user where username='{username}' ")
    users=cursor.fetchall()
    if(len(users)==1):
        cursor.close()
        return True
        
    else:
        cursor.close()
        return False
        
if __name__=="__main__":
    checkUser("shaddygarg")
    # checkUser(3)


