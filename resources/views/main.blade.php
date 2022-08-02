<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
    




<table class="table">
  <thead>
    <tr>
      <th scope="col">ID </th>
      <th scope="col">Student Ref. No,</th>
      <th scope="col">Full Name</th>
      <th scope="col">Email</th>
      <th scope="col">Mobile Number</th>
      <th scope="col">Payment For</th>
      <th scope="col">Amount</th>
    </tr>
  </thead>
  <tbody>
  @foreach ($data as $user)
    <tr>
      <th scope="row">{{$user->id}}</th>
      <th>{{ $user->student_ref_no }}</th>
      <td>{{ $user->fullname }}</td>
      <td>{{ $user->email }}</td>
      <td>{{ $user->payment_for }}</td>
      <td>{{ $user->amount }}</td>
    </tr>
@endforeach
   

  </tbody>
</table>

</body>
</html>