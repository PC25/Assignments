class Person:
    def __init__(self,name, city="Roorkee", *args):
        self.name = name
        self.city = city
        if(len(args)>=1):
            self.work=args[0]
    def show(self):
        print(f"My name is {self.name} and my current city is {self.city}")
        if self.work is not None:
            print( f"I am {self.work}")

if(__name__=="__main__"):
    person=Person("Ritvik", "Jabalpur", ["coding", "bakar", "ipl"])
    person.show()
    try:
        print(person.work)
    except Exception as error:
        print(error)
