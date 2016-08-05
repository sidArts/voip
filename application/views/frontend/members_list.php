<div class="container">
    <h1 class="page-header">Members</h1>
    <table class="table table-bordered table-hover">
        <tr>
            <th>Sl. no.</th>
            <th>Name</th>
            <th>Email</th>
            <th>Username</th>
            <th>Company</th>
            <th>Phone</th>
            <th>Joined at</th>
        </tr>
        <?php $slno = 1; ?>
        <?php foreach($members as $value): ?>
        <tr>
            <td><?php print $slno++; ?></td>
            <td><?php print $value->name; ?></td>
            <td><?php print $value->email; ?></td>
            <td><?php print $value->username; ?></td>
            <td><?php print $value->company; ?></td>
            <td><?php print $value->phone; ?></td>
            <td><?php print $value->created_at; ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>