# Movie/Game tech test - VueJS SPA with Laravel backend
This project is using Laravel Sail, simply run:

`./vendor/bin/sail up`

## Known Issues, ommissions, caveats etc... (in no particular order)
- omdbapi.com API endpoint URLs and button labels are hardcoded
- there's no logic to update existing records
- "imdbID" is being treated as a required and unique value to satisfy the "only store unique data in the DB" requirement
- Long story short, I was very short on time this week and rusty with some aspects of Laravel and VueJS, so the code is less than ideal and commits have been squashed to hide silly mistakes :) - happy to discuss
- I'm missing some linters/syntax helpers/IDE setup etc... so the syntax styling/layout is a bit off in places
- We're missing a lot of validation and error handling (just so you know i don't consider this production-ready by any means)
- I've added a basic unit test to show how testing the API might work but failed to get Dusk working in time (again, i'm time poor) but i was hoping to use that to Browser/Application test the VueJS SPA interface alongside the API unit tests