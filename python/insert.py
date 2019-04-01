import mysql.connector as mc


thisdb = mc.connect(
    host="localhost",
    user="ritvik",
    password="kundalmapur",
    database="project"
)
cursor=thisdb.cursor()
users=["abk.maloo","swapnil.negi09","k4ni5h","ayushjainaj20","shaddygarg"];

if __name__=="__main__"
    for x in users:
        query=f"insert into user values('{x}')"
        cursor.execute(query)

    thisdb.commit()