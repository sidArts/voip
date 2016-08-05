<div class="container">
    <h1 class="page-header">Post Details</h1>
    <div class="row">
        <div class="col-lg-5">
            <table class="table table-bordered">
                <tr>
                    <th>Post Type</th>
                    <td><?php print $post->post_type; ?></td>
                </tr>
                <tr>
                    <th>Quality Level</th>
                    <td><?php print $post->quality_level ?></td>
                </tr>
                <tr>
                    <th>Description</th>
                    <td><?php print $post->description ?></td>
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
                    <th>Country</th>
                    <td><?php print $post->country ?></td>
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
                    <td><a href="<?php print base_url(); ?>users/info/<?php print $post->user_id ?>"><?php print $post->username ?> (<?php print $post->name ?>)</a></td>
                </tr>
            </table>
        </div>
    </div>
</div>