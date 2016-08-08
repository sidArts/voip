<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Site Members</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <!-- Flash message for email success -->
            <?php if($this->session->flashdata('msg-sent-success')) { ?>
                <div class="alert alert-success">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <?php print $this->session->flashdata('msg-sent-success'); ?>
                </div>
            <?php } ?>
            <!-- Flash message for email fail  -->
            <?php if($this->session->flashdata('msg-sent-fail')) { ?>
                <div class="alert alert-danger">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <?php print $this->session->flashdata('msg-sent-fail'); ?>
                </div>
            <?php } ?>
            <div class="panel panel-default">
            <form action="<?php print base_url(); ?>admin/members/sendMessage" method="post">
                <div class="panel-heading">
                    <button class="btn btn-primary btn-sm" type="button" flag="unchecked" onclick="selectAllMember(this)">Check All</button>
                    <input type="submit" class="btn btn-success btn-sm" value="Send Message">
                </div>
                <div class="panel-body">
                    <table id="membersListTable" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="text-center">Sl. no.</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Username</th>
                                <th>Company</th>
                                <th>Phone</th>
                                <th>Joined at</th>
                                <th class="text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $slno = 1; ?>

                        <?php foreach($members as $value): ?>
                            <tr>
                                <td class="text-center">
                                    <label>
                                        <?php print $slno++; ?>
                                        <input type="checkbox" class="member-checkbox" name="email[]" value="<?php print $value->email; ?>">
                                    </label>
                                </td>
                                <td><?php print $value->name; ?></td>
                                <td><?php print $value->email; ?></td>
                                <td><?php print $value->username; ?></td>
                                <td><?php print $value->company; ?></td>
                                <td><?php print $value->phone; ?></td>
                                <td><?php print date('F j, Y, g:i a', strtotime($value->created_at)); ?></td>
                                <td class="text-right">
                                    <a href="<?php echo base_url(); ?>admin/members/info/<?php print $value->id ?>" class="btn btn-info btn-xs">view more</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                        </tbody>
                    </table>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>
<script>
    function selectAllMember(butt) {
        var members = document.getElementsByClassName('member-checkbox');
        if(butt.getAttribute('flag') == 'checked') {
            butt.innerHTML = 'Unchecked';
        }
        if(butt.getAttribute('flag') == 'unchecked') {
            butt.innerHTML = 'checked';
        }
        for(var i = 0; i < members.length; i++) {
            if(members[i].checked == true) {
                members[i].checked = false;

            } else {
                members[i].checked = true;
            }
        }
    }
</script>