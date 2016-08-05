<div class="container">
    <h1 class="page-header">Post Details</h1>
    <div class="row">
        <div class="col-lg-5">
            <table class="table table-bordered">
                <tr>
                    <th>Post Type</th>
                    <td>{post_type}</td>
                </tr>
                <tr>
                    <th>Quality Level</th>
                    <td>{quality_level}</td>
                </tr>
                <tr>
                    <th>Description</th>
                    <td>{description}</td>
                </tr>
                <tr>
                    <th>ASR</th>
                    <td>{asr}</td>
                </tr>
                <tr>
                    <th>ACD</th>
                    <td>{acd}</td>
                </tr>
                <tr>
                    <th>Country</th>
                    <td>{country}</td>
                </tr>
                <tr>
                    <th>Date Added</th>
                    <td>{created_at}</td>
                </tr>
                <tr>
                    <th>Views</th>
                    <td>{views}</td>
                </tr>
                <tr>
                    <th>Posted By</th>
                    <td><a href="<?php print base_url(); ?>users/info/{user_id}">{username} ({name})</a></td>
                </tr>
            </table>
        </div>
    </div>
</div>