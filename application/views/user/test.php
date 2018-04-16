<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Starter Boilerplate</title>
    </head>
    <body>
        <div id="app">
            <table border>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="user in users">
                        <td v-text="user.id"></td>
                        <td v-text="user.first_name"></td>
                        <td v-text="user.last_name"></td>
                        <td v-text="user.email"></td>
                        <td v-text="user.phone"></td>
                        <td v-show="user.status == 1">Active</td>
                        <td v-show="user.status == 0">Inactive</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <script src="https://unpkg.com/vue@latest/dist/vue.js"></script>
        <script>
        	let app = new Vue({
        		el: '#app',
        		data: {
        			users: []
        		},
        		created () {
                    fetch('<?php echo base_url("user/test/data"); ?>')
                        .then(response => response.json())
                        .then(json => {
                            this.users = json.users
                        })
        		}
        	})
        </script>
    </body>
</html>