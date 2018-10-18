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

### "send_exam=true&exam_name=" + exam_name + "&questions=" + questions


### instructor_user_name=sdaf

```json

{
"exams" : ["test1" : {"released" : true, "graded" : true},  "test2" : {"released" : false, "graded" : true}]
}

```


# Student

### student_user_name="sdf"

```json

{
"exams" : [{"test1" : "taken" , "test2" : "not taken"}]
}

```


### take_exam_name=test1


```json

{
"questions":["asdfasd", "asdfasfd"], 
"points" : [1,4]
}

```

### student_user_name=sdf&questions=["sadf", "sadf"]&points=[2,4]&answers=["sadf","sdaf"]


```json

{
"added" : "success"
}

```

