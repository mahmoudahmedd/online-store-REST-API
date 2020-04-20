[![MIT License][license-shield]][license-url]
[![LinkedIn][linkedin-shield]][linkedin-url]



<!-- PROJECT LOGO -->
<br/>
<p align="center">
  <a href="https://github.com/othneildrew/Best-README-Template">
    <img src="https://miro.medium.com/max/1400/1*sPLooWMag11pjZnzYXIQCA.png" alt="Logo" >
  </a>

  <h3 align="center">RESTful API for an Online Store</h3>

  <p align="center">
  RESTful API for an online store which can be used to help customers to buy or explore products and stores to market for their products.
    <br />
    <a href="https://github.com/mahmoudahmedd/store-online-API"><strong>Explore the docs »</strong></a>
    <br />
    <br />
    <a href="https://github.com/mahmoudahmedd/store-online-API/issues">Report Bug</a>
    ·
    <a href="https://github.com/mahmoudahmedd/store-online-API/issues">Request Feature</a>
  </p>
</p>



<!-- TABLE OF CONTENTS -->
## Table of Contents

* [About the Project](#about-the-project)
  * [Built With](#built-with)
* [Getting Started](#getting-started)
  * [Prerequisites](#prerequisites)
  * [Run Your PHP Script](#Run-Your-PHP-Script)
* [Documentation](#documentation)
* [Contributing](#contributing)
* [License](#license)
* [Contact](#contact)



<!-- ABOUT THE PROJECT -->
## About The Project


The project will be an online store platform. This platform will help customers to buy or explore products and small stores (businesses) to market for their products and get more customers. 

This platform is much like Amazon store but here our platform will focus on both online and onsite stores and both small business and big businesses.

In this project we will focus on building a reliable API for our store. 

<b>This platform consists of 6 main modules:</b>
* Users management
* Stores
* Products
* Brands
* Payments
* Statistics


### Built With
* [PHP 7.2](https://www.php.net/releases/7_2_0.php)
* [MySQL](https://www.mysql.com/)
* [JSON Data Model](https://www.json.org/json-en.html)




<!-- GETTING STARTED -->
## Getting Started

To get a local copy up and running, follow these simple example steps.

### Prerequisites

Setting up a development environment for PHP programming is easy. Download the code editor you prefer, I personally like <a href="https://atom.io/" target="_blank" rel="noopener">atom.io</a> text editor.

Next is to install <a href="https://www.apachefriends.org/download.html" target="_blank" rel="noopener">XAMPP 7.2.2</a>, the most popular PHP development environment. This package contains Apache, PHP & MariaDB or MySQL database applications.

### Run Your PHP Script

1. I'm using Windows, so my root server directory is
```
C:\xampp\htdocs\
```
2. Delete the Contents of the Folder
3. Go into the folder, then clone the repo:
```sh
git clone https://github.com/mahmoudahmedd/online-store-REST-API.git C:\xampp\htdocs\
```



<!-- Documentation -->
## Documentation

<b>Introduction</b>

With Online Store REST API you can get access to data in JSON format.

To access the data you just send a HTTP-request to address ```http://localhost/{controllerName}``` with controller-specific parameters. ```http://localhost/{controllerName}/{id}```

<br>

Each method call returns a JSON-object with three possible fields: status, message and data.

<b>Status is either "ok", "fail" or "exception".</b>
<br>
If status is "ok", then there is no message.
<br>
If status is "ok" then data contains JSON-element which will be described for each method separately. 
<br>
If status is "fail" or "exception", then there is no data.
<br>
If status is "fail" then comment contains the reason why the request failed. 
<br>
If status is "exception" then read the API documentation... Because there is a missing argument(s). 




<!-- CONTRIBUTING -->
## Contributing

Any contributions you make are **greatly appreciated**.

1. Fork the Project
2. Create your Feature Branch (`git checkout -b feature/AmazingFeature`)
3. Commit your Changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the Branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request



<!-- LICENSE -->
## License

Distributed under the MIT License. See `LICENSE` for more information.



<!-- CONTACT -->
## Contact

Mahmoud Ahmed - [Twitter @1243Mahmoud](https://twitter.com/1243Mahmoud) - mahmoud_ahmed@stud.fci-cu.edu.eg

Project Link: [https://github.com/mahmoudahmedd/online-store-REST-API](https://github.com/mahmoudahmedd/online-store-REST-API)



<!-- MARKDOWN LINKS & IMAGES -->
[license-shield]: https://img.shields.io/github/license/othneildrew/Best-README-Template.svg?style=flat-square
[license-url]: https://github.com/mahmoudahmedd/online-store-REST-API/blob/master/LICENSE.txt
[linkedin-shield]: https://img.shields.io/badge/-LinkedIn-black.svg?style=flat-square&logo=linkedin&colorB=555
[linkedin-url]: https://www.linkedin.com/in/mahmoudaahmedd/
