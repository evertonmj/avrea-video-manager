Welcome!

The Avrea Video Manager it's a streaming platform developed using Amazon Web Services resources. I used Amazon CloudFront to deliver content and S3 to store the videos.
You need to have an account at AWS to use this tool.


1. At AWS you'll need an EC2 Instance to Apache Web Server and MySQL Database Server.

2. You'll need the Yii Framework 1.1. After you place the framework, alter the index.php file to point the correct path to Yii Framework installation.

3. You'll need to configure the main.php file located on "protected/config" folder and configure the database, the AWS S3 Bucket and the CloudFront keys.

4. On folder "sql" there's a dump script to create the database needed for this application

After this, you'll can use this platform to stream your videos using AWS infrastructure.
If you have any questions, feel free to contact me.
