# BitterWebsite - A Twitter Clone

## Project Overview
The BitterWebsite project is a simplified Twitter clone developed during my time at NBCC as part of a hands-on PHP learning experience. The project focuses on implementing key social media functionalities such as user registration, login, and posting messages. The front-end template was provided by the instructor, while the back-end logic was developed as a practice exercise to reinforce PHP programming skills.

---

## Features
1. **User Registration and Authentication**:
   - Allows new users to register with a username and password.
   - Implements secure login functionality for registered users.

2. **Message Posting**:
   - Enables users to post "tweets" (short messages) on the platform.
   - Displays a feed of messages posted by all users.

3. **Responsive Front-End**:
   - Utilizes the provided HTML/CSS template for a visually appealing interface.
   - Ensures the layout is user-friendly and accessible.

4. **Database Integration**:
   - Stores user data and messages in a MySQL database.
   - Provides persistent storage for all user-generated content.

---

## Technical Specifications
- **Backend**: PHP
- **Frontend**: HTML, CSS (template provided by instructor)
- **Database**: MySQL
- **Architecture**:
  - Backend code is organized for maintainability and scalability.
  - Adheres to basic security practices, such as password hashing.

---

## How to Run
1. Clone the repository:
   ```bash
   git clone https://github.com/RicoRF/BitterWebsite.git
   ```

2. Set up the database:
   - Import the `bitter.sql` file (or equivalent) from the repository into your MySQL server.

3. Configure the database connection:
   - Update the `config.php` file with your database credentials (host, username, password, and database name).

4. Launch the project:
   - Place the project files in your local server directory (e.g., `htdocs` for XAMPP or `www` for WAMP).
   - Start your local server (Apache and MySQL).
   - Access the project in your browser at `http://localhost/BitterWebsite`.

---

## Lessons Learned
This project provided valuable experience in:
- Developing dynamic web applications using PHP and MySQL.
- Implementing basic CRUD (Create, Read, Update, Delete) operations in a real-world context.
- Strengthening understanding of server-side programming and database interactions.
- Practicing secure coding practices, such as input validation and password encryption.

---

## Future Enhancements
- Add user profiles to allow customization and better engagement.
- Implement a "like" and "reply" feature for messages.
- Enhance the security of user authentication by integrating modern frameworks.
- Optimize the front-end for improved responsiveness and interactivity.

---

## Author
**Federico Ferrante**  
Passionate full-stack developer with hands-on experience in building dynamic web applications.  
Feel free to reach out via [GitHub](https://github.com/RicoRF) or [LinkedIn](https://linkedin.com/in/ferranterico).

---

## License
This project is licensed under the MIT License. See the LICENSE file for details.
