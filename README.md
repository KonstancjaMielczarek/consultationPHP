# Web Application for Consultation Management
# Technologies

  - Front-end: HTML, CSS, JavaScript
  - Back-end: PHP
  - Framework: PHPSlim
  - Database: CakePHP
  - Email creation and transfer class: PHPMailer
  - Fake SMTP server: Mailtrap
  - Template engine: Twig

## Functionalities
### Created web application allows users:
  - Displaying a calendar with consultation dates for a given month.  
  - Send request for appointment (In the form, the user must enter his name, surname, email, subject and date of consultations).

### After logging in, the administrator has the ability to respond to a consultation request by:
  - Approving, rejecting or proposing a new consultation date.
  - After accepting the consultation date, an e-mail confirming the consultation date is sent to user.
  - The administrator can choose a new consultation date, the proposal is sent to the email.

### How to run:
  - Copy GitHub repository to Visual Studio Code
  - Run xampp
  - Create database called phpslim
  - Use "composer install" command in the terminal to install the necessary tools
  - Then use command "composer migrate" to create the database.
  - After that type "composer start".
  - Use any browser to run the application.

```sh
$ composer install
$ composer migrate
$ php -S localhost: 8080
```

Aplication based on PHPSlim Skeleton:
https://github.com/odan/slim4-skeleton?fbclid=IwAR0PNEnjYYnsWoOqLzFXNf2R5g-ix3gGLs3oG17rtS77wSaUAI4tdNrDcN8
