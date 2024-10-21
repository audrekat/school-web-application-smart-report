-- Create the Admin table
CREATE TABLE Admin (
    Name VARCHAR(100),
    Surname VARCHAR(100),
    Email VARCHAR(100),
    Password VARCHAR(50),
    Date_created DATE
);

-- Create the Parent table
CREATE TABLE Parent (
    Parent_id INT(11) AUTO_INCREMENT PRIMARY KEY,
    Name VARCHAR(100),
    Surname VARCHAR(100),
    Parent_id_number BIGINT(15),
    Contact BIGINT(15),
    Address VARCHAR(100),
    Email_address VARCHAR(100),
    Date_created DATE
);

-- Create the Learner table
CREATE TABLE Learner (
    Learner_id INT(11) AUTO_INCREMENT PRIMARY KEY,
    Name VARCHAR(100),
    Surname VARCHAR(100),
    ID_number BIGINT(15),
    Parent_id INT(11),
    Address VARCHAR(100),
    Grade VARCHAR(10),
    Date_of_birth DATE,
    Date_created DATE,
    FOREIGN KEY (Parent_id) REFERENCES Parent(Parent_id)
);

-- Create the Subjects table
CREATE TABLE Subjects (
    Subject_ID INT(11) AUTO_INCREMENT PRIMARY KEY,
    Subject_name VARCHAR(50) UNIQUE
);

-- Insert predefined subjects into the Subjects table
INSERT INTO Subjects (Subject_name) VALUES
('Mathematics'),
('Science'),
('History'),
('English'),
('Geography'),
('Art'),
('Music'),
('Computer Science'),
('Sepedi'),
('IsiZulu'),
('Accounting'),
('Biology'),
('Chemistry'),
('Physics');

-- Create the Subject table
CREATE TABLE Subject (
    Subject_ID INT(11) AUTO_INCREMENT PRIMARY KEY,
    Learner_id INT(11),
    Subject_ID_FK INT(11),
    Grade VARCHAR(10),
    Term VARCHAR(10),
    Year INT(10),
    Date_created DATE,
    FOREIGN KEY (Learner_id) REFERENCES Learner(Learner_id),
    FOREIGN KEY (Subject_ID_FK) REFERENCES Subjects(Subject_ID)
);

-- Create the LearnerSubjects junction table
CREATE TABLE LearnerSubjects (
    Learner_id INT(11),
    Subject_ID INT(11),
    PRIMARY KEY (Learner_id, Subject_ID),
    FOREIGN KEY (Learner_id) REFERENCES Learner(Learner_id),
    FOREIGN KEY (Subject_ID) REFERENCES Subjects(Subject_ID),
    CONSTRAINT chk_max_subjects CHECK (
        (SELECT COUNT(*) FROM LearnerSubjects WHERE Learner_id = Learner_id) <= 3
    )
);

-- Create the Teacher table
CREATE TABLE Teacher (
    Teacher_ID INT(11) AUTO_INCREMENT PRIMARY KEY,
    Name VARCHAR(100),
    Surname VARCHAR(100),
    Email VARCHAR(100),
    Subject_ID INT(11),
    Contact BIGINT(15),
    Password VARCHAR(50),
    Date_created DATE,
    FOREIGN KEY (Subject_ID) REFERENCES Subjects(Subject_ID)
);

-- Create the Report table
CREATE TABLE Report (
    Report_ID INT(11) AUTO_INCREMENT PRIMARY KEY,
    Subject_ID INT(11),
    Comment TEXT,
    Date_created DATE,
    FOREIGN KEY (Subject_ID) REFERENCES Subject(Subject_ID)
);

-- Create the Comment table
CREATE TABLE Comment (
    Comment_ID INT(11) AUTO_INCREMENT PRIMARY KEY,
    Subject_ID INT(11),
    Comment VARCHAR(255),
    Date_created DATE,
    FOREIGN KEY (Subject_ID) REFERENCES Subject(Subject_ID)
);

-- Create the UserLogin table
CREATE TABLE UserLogin (
    UserID INT(11) AUTO_INCREMENT PRIMARY KEY,
    Username VARCHAR(100),
    Password VARCHAR(50),
    Role VARCHAR(50) -- Admin, Parent, Teacher
);
