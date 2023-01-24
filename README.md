# Example Usage

Register
--------
curl -i -X POST -H 'Content-Type: application/json' -d '{"username": "u1", "password": "p1"}' http://localhost:8000/register

Login
-----
curl -c cookies.txt -i -X POST -H 'Content-Type: application/json' -d '{"username": "u1", "password": "p1"}' http://localhost:8000/login

Create New Note
--------------
curl -b cookies.txt -i -X POST -H 'Content-Type: application/json' -d '{"content": "My note content"}' http://localhost:8000/todoNote

View Logged In User's Notes
---------------------------
curl -b cookies.txt -i -X GET -H 'Content-Type: application/json' http://localhost:8000/user/me/todoNotes

View Arbitrary User's Notes
---------------------------
curl -i -X GET -H 'Content-Type: application/json' http://localhost:8000/user/u1/todoNotes

Delete Note
-----------
curl -b cookies.txt -i -X DELETE -H 'Content-Type: application/json' http://localhost:8000/todoNote/1

Mark Note Complete
-------------------
curl -b cookies.txt -i -X PATCH -H 'Content-Type: application/json' -d '{"complete": true}' http://localhost:8000/todoNote/1/complete


Mark Note Incomplete
--------------------
curl -b cookies.txt -i -X PATCH -H 'Content-Type: application/json' -d '{"complete": false}' http://localhost:8000/todoNote/1/complete

