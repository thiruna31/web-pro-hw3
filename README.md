# Homework 03 — Chez Session

**Student:** Thirunavukkarasu Palaniappa  
**Course:** Web Programming  
**Project:** Homework 03 — PHP Sessions

## About the Project

Chez Session is a small dessert and drink ordering website that I built for my Web Programming homework. The main purpose of this assignment was to practice working with PHP sessions and understand how a website can remember a user's choices while they move between pages.

The website allows customers to select a dessert, choose a drink, and pick a drink size. After submitting the form, they can view their order summary and total price. They can also return to the form without losing their previous selections or clear their order and start fresh.

I kept the design simple so the ordering process would be easy to follow.

## Live Website

**CODD Website:**  
https://codd.cs.gsu.edu/~tpalaniappa1/Web/HW/hw3/index.php

**GitHub Repository:**  
https://github.com/thiruna31/web-pro-hw3



## Technologies Used

- HTML5 for the page structure
- CSS3 for styling and layout
- PHP for processing orders and managing sessions
- XAMPP for local development and testing
- GSU CODD server for hosting
- Git and GitHub for version control

## How the Website Works

When someone opens the website, they see a form with dessert and drink options.

After the user submits the form, PHP processes the selections and stores them in session variables:

- `$_SESSION['dessert']`
- `$_SESSION['drink']`
- `$_SESSION['drinkSize']`

These variables help the website remember the order during the browsing session.

The receipt page displays the selected items and the calculated total. When the user chooses **Order Again**, the form restores their saved selections. When they choose **Forget Order**, the saved order is cleared so they can begin again.

This assignment helped me understand the difference between submitting form data and keeping information available across multiple PHP pages.

## Project Files

| File | Purpose |
|---|---|
| `index.php` | Displays the main ordering form |
| `process_order.php` | Processes the submitted order and displays the receipt |
| `order_functions.php` | Contains shared PHP functions and session-related logic |
| `forget_order.php` | Clears the saved order |
| `about.php` | Provides information about the project |
| `styles.css` | Controls the website's appearance |

## Running the Project Locally

I developed and tested the project using XAMPP.

To run it locally:

1. Install XAMPP and start Apache.
2. Copy the project files into a folder inside `C:\xampp\htdocs`.
3. Open a browser and visit the corresponding localhost address.

For example, if the folder is named `web pro hw3`, the URL is:

`http://localhost/web%20pro%20hw3/index.php`

PHP must run through a web server, so opening the PHP files directly from the file explorer will not work correctly.

## Testing and Validation

I tested the website locally using XAMPP and uploaded the PHP files to the GSU CODD server.

The main features to test are submitting an order, viewing the receipt, returning to the form with saved selections, and clearing the order.

I also checked `styles.css` using the official W3C CSS Validation Service. The validator reported **zero errors and one warning** about a vendor-specific font setting. The stylesheet passed CSS Level 3 + SVG validation.

HTML validation and cross-browser testing should also be completed and documented as part of the final assignment submission.

## What I Learned

The most useful part of this project was learning how PHP sessions work in a real website.

Before this assignment, I was more familiar with building forms and displaying information on a page. Working on Chez Session helped me understand how information can be stored temporarily and reused across different requests.

I also gained more experience organizing PHP files, testing a website locally, transferring files to a remote server using Git Bash, and checking CSS with an online validator.

## Acknowledgment

This project was completed for educational purposes as part of my Web Programming coursework. I used development tools and AI assistance for guidance, explanations, troubleshooting, and documentation support.

The project demonstrates PHP form handling, session management, and basic website deployment.
