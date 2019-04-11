<table>
    <thead>
        <tr>
            <th> id</th>
            <th> price</th>
            <th> created_at</th>
        </tr>
    </thead>
    <tbody>
         @foreach($sales as $sale)
          <tr>
              <td> {{$sale->id}} </td>
              <td> {{$sale->price}} </td>
              <td> {{$sale->created_at}} </td>
          </tr>
         @endforeach
   </tbody>
</table>