<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-8">
            <div class="panel panel-primary" style="margin-top: 5px;">
                <div class="panel-heading">
                    <h2 class="page-header">Post Details</h2>
                </div>
                <div class="panel-body">
                    <table class="table table-hover">
                        <tr>
                            <th>Post Type</th>
                            <td><?php print $post->post_type; ?></td>
                        </tr>
                        <tr>
                            <th>Quality Level</th>
                            <td><?php print $post->quality_level ?></td>
                        </tr>
                        <tr>
                            <th>Country</th>
                            <td><?php print $post->country ?></td>
                        </tr>
                        <tr>
                            <th>ASR</th>
                            <td><?php print $post->asr ?></td>
                        </tr>
                        <tr>
                            <th>ACD</th>
                            <td><?php print $post->acd ?></td>
                        </tr>
                        <tr>
                            <th>Rate</th>
                            <td><?php print $post->rate ?></td>
                        </tr>
                        <tr>
                            <th>Description</th>
                            <td><?php print ($post->description) ? $post->description : 'not available'; ?></td>
                        </tr>
                        <tr>
                            <th>Date Added</th>
                            <td><?php print date('F j, Y, g:i a', strtotime($post->created_at)) ?></td>
                        </tr>
                        <tr>
                            <th>Views</th>
                            <td><?php print $post->views ?></td>
                        </tr>
                        <tr>
                            <th>Posted By</th>
                            <td><a href="<?php print base_url() ?>admin/members/info/<?php print $post->user_id ?>"><?php print $post->name ?></a></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>