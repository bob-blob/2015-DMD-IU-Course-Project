# 2015-DMD-IU-Course-Project
This is the first version of the Data Modelling and Databases course project that was developed during the first semester in Innopolis University '15.

1. Download dblp.xml and dblp.dtd from http://dblp.uni-trier.de/xml/, and save them at
the same folder.


2. Restore the database with mysql dump file (dblp.sql)
Suppose you have already installed mysql database. 
You may first log to your mysql and then use "source" command to restore the database:
mysql>> source path_of_dblp.sql

If everything goes well, a database named dblp with four tables (i.g., author, citation,
conference, paper) has been created.


3. Configure database connection
Please change the settings (i.g., dbUrl, user, password) in db/DBConnection.java accordingly.


4. Run the parser
a. Using IDE, for example, Eclipse.
You need to add mysql-connector-java-6.0-bin.jar to the build path. 
See this post if you need any help.
http://www.wikihow.com/Add-JARs-to-Project-Build-Paths-in-Eclipse-(Java)

And then run Parser.java with proper program argument (the path of dblp.xml) and VM
arguments (-Xmx1G -DentityExpansionLimit=2500000). You may see this post on how to specify 
arguments in Eclipse.
http://www.cs.colostate.edu/helpdocs/eclipseCommLineArgs.html

b. Using the command line
Similarly, you need to add mysql-connector-java-6.0-bin.jar in the classpath, and set
the arguments. The command will be something like:
java -cp mysql-connector-java-6.0-bin.jar -Xmx1G -DentityExpansionLimit=2500000 Parser [path_of_dblp.xml]

The program will run for a while. For example, it takes 974 seconds to parse dblp-2014.xml using my desktop. 

## Future features

Next major release:  

1. Parse journals, books and theses as well. 

<article key="journals/ac/Wexelblat75">
<author>Richard L. Wexelblat</author>
<title>Programmed Control of Asynchronous Program Interrupts.</title>
<pages>1-41</pages>
<year>1975</year>
<volume>13</volume>
<journal>Advances in Computers</journal>
<url>db/journals/ac/ac13.html#Wexelblat75</url>
</article>