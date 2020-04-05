# Installation: 

  1. Ensure MySQL is installed on local machine
  2. Ensure PHP is installed on local machine
  3. Run the following Init command
  
```
$ cd 8Light 
$ bookshelf Init

```


# Usage:

- `bookshelf Search` accepts a *string* for its **params** argument. The string can be a single word or a mix of words. i.e.


```

$ bookshelf Search "The Life of Pi"

```

- Using the Search command will call 5 books depending on the API call to GoogleBooks and give you the option to add books to your local ReadingList through yes/no prompts and an interactive menu
- `bookshelf ReadingList` does not accept parameters and displays a list of all books added to your local ReadingList
- You have the option to delete any of the books in your ReadingList through similar yes/no prompts and an interactive menu
- Adding -h at the end of a command should pull up a list of the descriptors and inputs





# Assumptions:

- It was assumed that the CLI application did not need a heavy visual interphase. A menu was added so as to address the 3rd acceptance criteria on the assignment (choosing from the 5 books). However, the CLI application does not have a single cohesive start and finish process in a single experience. Rather, it addresses initialization and the rest of the criteria through 3 different commands. 
- It was assumed that the application did not need to be hosted or successfully distributed through npm or any other channels
- MySQL username was set to root without password. It was assumed that the user would be able to manage this if their local environment is different. Configuration for MySQL can be found at `/config/database.php` on like 51-53 (approximately)

 

# Decisions Made:

- Functionality was clustered on 3 different commands. At first, I started with the search command and was thinking about building out separate commands to reflect CRUD operations. However, this felt a little fractured when I thought about the User Experience. A user would not want to start the search process and then add a book by ID with a different process. Instead, the search command gives the user the ability to add a selected book (including ID for internal and future external purposes). 
- Similarly, the ReadingList command couples show and delete functionalities without the ability to update/edit a selected book. In the future, I can expand on different CRUD methods in order to include descriptions, user notes, or reviews. 
- Gandalf quotes displayed when answering **No** on prompts are to be whimsical. Because the command exits, I believe the user understands that the process is reset and currently I do not think that the heuristics of this app are broken because of it.


License
----
MIT