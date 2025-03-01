<!DOCTYPE html>
<html lang="en">

<head>
</head>

<body>
    <div>
        <div><b>Name: </b><span>{{ $sender->full_name }}</span></div>
        <div><b>Email: </b><span>{{ $sender->email }}</span></div>
        <div><b>Phone Number: </b><span>{{ $sender->phone_number }}</span></div>
        <div><b>Message: </b><span>{{ $sender->message }}</span></div>
    </div>
</body>

</html>
