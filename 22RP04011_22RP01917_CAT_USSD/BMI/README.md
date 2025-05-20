 BMI Calculator USSD Application

This is a USSD and SMS application that enables users to calculate their Body Mass Index (BMI) after registration. The application uses Africa's Talking API for USSD and SMS functionality.

 Prerequisites
- XAMPP
- Africa's Talking Account
- ngrok (for local development)
- Postman (for testing)
 Application Credentials

 Africa's Talking Configuration
 ..............................
- API Key: `atsk_3e95dda04d9d37f96911e26e7c32cc9f6110027998a37c08aad86992dd75a8c8a089350d`
- Username: `sandbox`
- Sender ID: `bmi`
- USSD Service Code: `*384*170403#	`
- 

 Test User Credentials
 ..........................

- Phone Number: `+250790222449`
- PIN: `1234`

 WE Setup Instructions
 ..............................

1.  we Clone  XAMPP htdocs directory:
   ```
   cd /path/to/xampp/htdocs
   
   ```

2. we create  database:
   
   - database named `bmi`
   

3. WE Configure the application:
   - in `config.php`
   - by setting  Africa's Talking API credentials:
     ```php
     define('AT_API_KEY', 'atsk_f4d53cd4b4562503487f2ed348c16f8729eee2467352f0e01977ec2d3b8e778a4bce20b5');
     define('AT_USERNAME', 'sandbox');
     define('SERVICE CODE', '**384*170304#');
     ```

4.  ngrok for local development:
   ```
   ngrok http 80
   ```

5. WE Configure Africa's Talking:
   - WE  Africa's Talking account
   - Go to USSD settings
   - Set the USSD callback URL to your ngrok URL + /ussd.php
   - Set the SMS callback URL to your ngrok URL + /sms.php

  Testing the Application
  ......................

   Using Postman
   .............
1. we  new POST request to your ngrok URL + /ussd.php
2. we set following parameters:
   ```
   sessionId: 12345
   serviceCode: *384*170304#
   phoneNumber: +254786525963
   text: 
   ```

    we  Using a Mobile Phone
1. Dial the USSD code: `*384*170304#`
2. Follow the prompts:
      for UN REGISTERED USER
      ........................
   - Enter your name
   - Create and confirm PIN
   - confrm your PIN

     FOR REGISTERED USER
      ........................
   
   
   - Enter height in meters
   - Enter weight in kilograms
   - Confirm details
   - Receive BMI results via SMS

      Application Flow
      .........................
    Registration 
    .................

1. Enter name
2. Create PIN
3. Confirm PIN
4. Receive confirmation SMS

  BMI Calculation Process
  .......................
1. Enter height (meters)
2. Enter weight (kilograms)
3. Confirm details
4. Receive BMI results and recommendations via SMS

   BMI Categories
   ....................
- Underweight: BMI < 18.5
- Normal weight: BMI 18.5 - 24.9
- Overweight: BMI 25.0 - 29.9
- Obesity: BMI ≥ 30.0

    File Structure
    .......................
- `UTIL.php` - Configuration 
- `BMI.sql` - Database schema
- `MENU.php` - USSD session handler
- `sms.php` - SMS sending functionality
- `README.md` - Documentation

   Security Features
   ...................
- Prepared statements for database queries
- Input validation
- Secure session handling



 DONE BY  GILBERT NIYOMUREMYI & IGIHOZO PATIENCE, please contact:
-
- Phone: 0786525963  .gilbert
       : 0790222449   .patience
 