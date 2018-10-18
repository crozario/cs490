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

### add_question=true&question="find the square of two numbers"&function_name="square"&function_parameters=2&test_case_in=2&test_case_out=3

```json

{
"added" : true
}

{
"added" : false
}

```




# Student
### 