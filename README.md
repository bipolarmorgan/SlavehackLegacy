Slavehack: Legacy
===============

## F.A.Q.

### What is this?

Slavehack: Legacy is an open-source continuation of the popular online game "Slavehack". For emphasis, **_this is not Slavehack 2_** nor is it being developed by the same people who are working on Slavehack 2 (as of now, anyway). Think of this as a spiritual successor to the original Slavehack.

### Who are you?

To you, I'm a web developer, and was looking for open-source projects to put my mind to since I had picked up PHP awhile ago. I recalled playing Slavehack quite some time ago (I was/am a huge fan of the game and even brought some of my friends to play with me), and remembered that it was purely web based. I took a look around the forums and (much to my dismay) it was fairly inactive. I did however notice that there was a somewhat decent thread that popped up about an open-source recreation of Slavehack that was posted back in January of this year, so I hopped on the project to see what I could do.

### Why is this project no longer on BitBucket? Why does nothing look the same?

I've completely scrapped the project that was hosted on BitBucket. Nothing in that project will be found in this project, and there are a few reasons for that. The first reason is that the project on BitBucket utilized several, several frameworks all lumped together, none of which were included into the actual project. This caused me to be unable to run the project, even after trying to find all the different frameworks placed into that project. 

The second reason is that the code organization was less than appealing to me. Don't get me wrong, Rummik, Trizzel, and Pengi all did a great job at programming what they did, but it was less than functional and very disorganized which made it nearly impossible to make my way around the project itself. For this reason I was unable to actually work on the things I tried to because a lot of it was scattered about (SQL files being stored in actual .sql files, odd folder structure, etc.).

For these reasons it was ultimately easier and better for me to scrap the project and restart from the very beginning where I had a firm grasp of everything that was going on and could make project management far easier.

### Why did the previous project on BitBucket cease development?

If you want a full answer, you should contact one of the three developers that worked on it, as I did not. I contacted Trizzel over e-mail who gave me all the explanation I needed, which is that they all became too busy to devote enough time to developing the project. Like I said, if you want a full answer you should contact Trizzel, Rummik, or Pengi.

## The Game

### Currently implemented features

As of right now, the following features have been implemented into the game:

* Registration
* Login system
* My Computer
* Randomly generated IPs/Passwords for new users
* Logs that can be edited / accessed by other users or yourself
* Dynamic wallpaper function to allow for changing of wallpapers
* Connecting to different IP addresses
* Embedded chat channels utilizing Socket.IO. Connect to a specific IP and it will be host to a page that will hold
  a chat room for all those connected to that IP.

### Features that will for sure be coming

* Finishing the statistics side of the My Computer page
* "E-mail" system for users to PM other users. May also be used for randomized missions/riddle trails.
* Processes tab to manage different types of processes ongoing in your computer
* Fleshing out the internet tab (right now it's a placeholder)
* Files tab where you will manage not only your files for hacking, but your wallpaper as well.
* In tandem with the above, I am debating on whether or not to add BG music that is uploadable as well. This will most likely be coming as well. It won't be until down the road quite a ways, however.
* Slaves tab to access all of your current slaved computers as well as managing them for DDoS, managing what software they can host for others to download, as well as potentially other features.
* Forums for users to post in. This won't be until a long ways down the line as this will likely take me the longest to actually implement into the game itself.
* Randomized missions / riddletrails. Further explained below.

### Optional features you may see in the future

* Dynamic color scheme
* AJAX managed logs system
* The above AJAX managed logs system may not be replaced, but instead a chat system at hubs located around certain IPs on the internet can be accessed for users to talk and discuss.
* Potential team effort hacking (more users hacking at once = less time to hack for everyone?)
* And more...

### New missions / riddle trail system?

Yes, and I have a fairly good idea of how I plan on implementing this system as well so I might as well write it down here for safe keeping. I plan to have a timer tick every (x amount of time) which does the following things:

  1. Generates a single (maybe multiple in the future, though that gets complicated) IP address host to an NPC
  2. Generates thirty different numbers, and pulls these from the players table, where the numbers correspond with the         player's unique ID. For example, if I were player 25, and one of the numbers generated was 25, I would receive an         in-game e-mail about it. If one of the numbers does not match the generator will re-pick this number until it finds a      corresponding player to give it to. No player will receive a duplicate e-mail.
  3. The game sends out this e-mail to the players with the lead on the riddle trail / mission, who can then share it or        keep it to themselves.
  4. Players will hack into the NPC in an attempt to grab whatever software is hosted on that NPC.

Right now this is just a proof of concept (if you can even call it that), but it's how I'm envisioning this new system will work. In addition there will be a similar primary riddletrail that players can follow. However I want to implement this randomized design so that players are incapable of uploading the entire riddle trail for other players to cheat off of, and instead allows more variety into the game.

### Ok enough with the words, where's the pictures

Alright, here's the fruits of your labor for reading all of that (I'll assume you did):

#### Home page
http://i.gyazo.com/d8c4530fae10f1f508745668148266c3.png

#### Registration page
http://i.gyazo.com/a86fa06efb1265ba4f5873ff34caab6c.png

#### Login page
http://i.gyazo.com/4211b2c5140c5bc1af7d9143045c65c8.png

#### My Computer page
http://i.gyazo.com/61201c8683127d1ca231b074615bc7ae.png

#### Logs page
http://i.gyazo.com/5faa6d5614632bd76216a4977631d869.png

#### Internet page
http://i.gyazo.com/4ed7247e809b8de9cc88a5fd15507364.png
http://i.gyazo.com/60f7735f536321ea08afba4c8dabe9ad.png

#### Sample chat channel
http://puu.sh/asCaf/9745960c29.png

##### Note

If the images are blurry just zoom out, it should fix them.
