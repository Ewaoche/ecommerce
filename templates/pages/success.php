
<div class="container">
<h2>Success, your payment went through. You can download your transaction by clicking on the Download button below!</h2>
<table>
    <tr>
        <th> Summary </th>
    </tr>
    <tr>
        <td>First Name : <?= $getWallet->firstname ?> </td>
    </tr>
    <tr>
        <td>Last Name : <?= $getWallet->lastname ?> </td>
    </tr>
    <tr>
        <td>Amount : <?= $getWallet->amount ?></td>
    </tr>
    <tr>
        <td>Reference Code : <?= $getWallet->reference ?> </td>
    </tr>
    <tr>
        <td>Date : <?= date("jS F Y", strtotime($getWallet->created_on)) ?> </td>
    </tr>
    
    <tr>
        <td><a href="#">Download Now!</a> </td>
    </tr>
</table>
</div>

