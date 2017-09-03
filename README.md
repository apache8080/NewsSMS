# NewsSMS
This was my hackathon project at HS Hacks 1 on March 9th, 2014. It is as application that allows users to text in google news searches and then the app texts back the top 5 results on google news and uses the Clipped.me api to summarize those articles into a few sentences. Here is a link to the challenge post page on my project: http://hshacks.challengepost.com/submissions/21417-news-sms

To send texts I used the a mail server in php and sent an email to the phonenumber@txt.att.net(eg. "4083456789@txt.att.net"). I used the Google News API for getting the news results. To send a summarized version of the article I used the clipped.me API.

For the app to work you will need to set $username and $password, in the reply.php file, to a username password combo for GMAIL for security reasons you should probably use env variables.
