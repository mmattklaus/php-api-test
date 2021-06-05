<?php
require "Models/User.php";

use \Models\User;

$user = new User(1);
$user_data = $user->user;
$clubs = $user->getClubs();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Suh, AppTest</title>
    <link rel="stylesheet" href="https://unpkg.com/buefy/dist/buefy.min.css">
</head>

<body>
<div id="app">
    <section class="hero is-primary mb-6 ">
        <div class="hero-body">
            <div class="columns is-multiline is-mobile">
                <div class="column is-narrow">
                    <img class="mt-4" height="48" width="48" style="border-radius: 50%;" :src="user.profile.picture">
                </div>
                <div class="column is-three-quarter">
                    <p class="title">
                        <span>WELCOME, {{ user.profile.firstName }} {{ user.profile.lastName }}</span>
                    </p>
                    <p class="subtitle">
                        @<code>{{ user.username }}</code>
                    </p>
                </div>
            </div>

        </div>
    </section>
    <div class="container">
        <strong class="is-size-1">Clubs</strong>
        <hr>
        <div class="columns is-multiline is-mobile">
            <div v-for="club in clubs" :key="club.id" class="column is-one-quarter">
                <div class="card">
                    <div class="card-content">
                        <div class="media">
                            <div class="media-left">
                                <figure class="image is-48x48">
                                    <img :src="club.profile.picture" :alt="club.name">
                                </figure>
                            </div>
                            <div class="media-content">
                                <p class="title is-4">{{ club.name }}</p>
                                <p class="subtitle is-6">@<code>{{ club.handle }} </code></p>
                            </div>
                        </div>
                        <br>

                        <div class="content">
                            {{ club.profile.description }}
                            <br>
                            <time datetime="2016-1-1">{{ new Date(club.dateCreated * 1000).toLocaleDateString() }}
                            </time>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://unpkg.com/vue"></script>
<!-- Full bundle -->
<script src="https://unpkg.com/buefy/dist/buefy.min.js"></script>

<!-- Individual components -->
<script src="https://unpkg.com/buefy/dist/components/table"></script>
<script src="https://unpkg.com/buefy/dist/components/input"></script>

<script>
    new Vue({
        el: '#app',
        data: {
            user: JSON.parse('<?php echo json_encode($user_data); ?>'),
            clubs: JSON.parse('<?php echo json_encode($clubs); ?>')
        }
    })
</script>
</body>
</html>