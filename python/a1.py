import mysql.connector as mc

thisdb = mc.connect(
    host="localhost",
    user="ritvik",
    password="kundalmapur",
    database="project"
)
cursor= thisdb.cursor()
cursor.execute("CREATE TABLE user(username varchar(255) not null)")