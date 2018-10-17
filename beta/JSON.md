# Login
### username=***&password=***

```json

{
"login" : "student"
}

{
"login" : "instructor"
}

{
"login" : "fail"
}

```
# Instructor
### get_pending_exams=true

```json

{
"found_exams" : true,
"exams" : ["test1" : { "scores_released" : true }, "test2" : { "scores_released" : false} } ]
}

{
"found_exams" : false
}
```

### get_question_bank=true

```json

{
"found_questions" : true,
"questions" : [ "12asdf" : { "question" : "find the square of two numbers", "topic" : "recursion", "difficulty" : "hard" } ]
}

{
"found_questions" : false
}

```

### add_question=true&question="find%20the%20square%20of%20two%20numbers"&function_name="square"&function_parameters=2,2&testcases=

```json

{
"question_added" : true
}

{
"question_added" : false
}

```




# Student
### 