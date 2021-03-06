# My work On the Task
- I added link to access APIs ( api/doc )
- Create Fixture to load data
- Generate Entities
- Similar Response structure for all APIs
- handle error for not found artist or album

### you need to create database and run migration and for sure load fixtures
### I use nelmio API Doc to help me
### I assumed that all lengths inside the json for fixtures is 00:00 without hours

### How did I build this app proccess and thoughts.
- I created database according to the json file Artist -> Albums -> Songs
- After that I started to create the fixtures and apply it 
- Then I start creating controller for artist and another one for album 
- I always use Nelmio Bundle which helps me in documentation a lot
- I created Util class to convert from time to seconds and vice versa 
- I created BaseController to have common functions that I always use in any Controllers 

### Time consuming 
I spent time downloading Docker PHP7.2 because I have 7.1
Also, to make everything work it took about 80min
I start work after that I think fixture took about 30-50min
I start to make APIs it took about 30min

### Important note
This my fisrt time use Symfony4 
I use Symfony3.4 for 2.5 years and Symfony2.8 for 1 year
It's very similar to 3.4 except some new features and directories structure

----------------------------------------------------------------------------------
# Codebase backend applicants

In order to judge your developer skills we would like you to do the following task.
The task should not exceed 3 hours of working time. After that time simply stop working
on the task.

Finished or unfinished we would like to see your result and a couple of words
of feedback from your end in order to get a better understanding of your thought process.
Explain how you went about your implementation and how you would have approached the
open tasks in case you could not finish the test in time.

Send your feedback by creating a pull-request from your repository to the original one:
https://github.com/gimmenetwork/application-backend-artists

We are excited to see what you folks will be handing in!

### Additional instructions

Pay extra attention to the unique token requirement for artists and albums. Ensure that
the `token generation` would always result in a unique token. Think big!

Also, don't worry in case you will not finish in time. Make sure we can follow your thought process!

## Requirements

- PHP 7.1.3+
- MySQL
- Git skills
- Github account
- Composer skills
- Symfony 4 skills
    - Doctrine

## Installation

- Fork this repository
- Clone your forked repository so that you can work on it 
- Install the composer packages

Now you should be able to run `bin/console server:run` to start up your development server.

## Your task

It is up to you on how you want to structure your app. Fulfill the following requirements:

1. Build a database with doctrine based on the following dataset:
    * https://gist.github.com/fightbulc/9b8df4e22c2da963cf8ccf96422437fe
    * Import the dataset by using fixtures
        * Artists and albums should get an additional property `token`
            * ensure that token will be unique
            * length of 6 characters
            * use `App\Utils\TokenGenerator` to generate a token
            * should look something like this `3KF6YK`
        * Songs
            * transform the length to seconds
2. Make the data available via the following REST endpoints:
    * `GET /artists`
        * show all artists with `token` and `name`
        * show related albums with `token`, `title`, `cover`
    * `GET /artists/[token]`
        * same as for `GET /artists` but only for the requested artist
    * `GET /albums/[token]`
        * show album data `token`, `title`, `description`, and `cover`
        * show related artist with `token` and `name`
        * show related songs with `title` and `length` (in minutes)
    * Response should be in JSON
    * Make sure to handle empty results with the correct response

Something not clear, do you need more information to do the test? Have a look at existing issues
or create a new one in case you didn't see your question yet. Don't be afraid to ask!
