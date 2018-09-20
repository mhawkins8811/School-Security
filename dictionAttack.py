'''
Michael Manzanares
Assigment 1:  This assigment is tasking us to crack three passwords through three different methods.
One method is the random password, with a brute force technique.  Second method is using the dictionary attack
and the other method is an online attack.  Each attack is to be tested on a site made by Dr. Longpre.  All sources used
can be found in the reference section of the report.  There weren't any sources left out.
Prof: Dr. Longpre
02/18/2018
'''


from Tkinter import Tk
from tkFileDialog import askopenfilename
import hashlib
Tk().withdraw()
filename = askopenfilename()
print "Enter hash code: "
hashedTObreak =raw_input()
print "Enter salt: "
salt =raw_input()
def main():
    fileobj = open(filename)

    for line in fileobj:
        line = line.rstrip('\n')

        if(hashlib.sha1(line+salt).hexdigest()==hashedTObreak):
            print "The password is " + line
            break

if __name__== "__main__":
    main()



'''
Again all sources have been placed in the report.  As reminded by professors and TAs that code comments are a bad smell.
'''