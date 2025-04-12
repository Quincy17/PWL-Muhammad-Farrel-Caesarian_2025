<!DOCTYPE html>
 <html>
 <head>
     <title>Data User</title>
 </head>
 <body>
     <h1>Data User</h1>
     <table border="1" cellpadding="2" cellspacing="0">
         <tr>
             <th>ID</th>
             <th>Level ID</th>
             <th>Username</th>
             <th>Nama</th>
             <th>Password</th>
         </tr>
         @foreach ($data as $d)
         <tr>
             <td>{{ $d->user_id }}</td>
             <td>{{ $d->level_id }}</td>
             <td>{{ $d->username }}</td>
             <td>{{ $d->nama }}</td>
             <td>{{ $d->password }}</td>
         </tr>
         @endforeach
     </table>
 </body>
 </html>