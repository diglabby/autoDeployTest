# Для аутаматычнага разгортвання зменаў з гітхаб трэба
 * SSH доступ да дамена з дасягам на выкананне git каманд.
 * Стварыць клон свайго рэпазіторыя на дамене
 ```
 git clone "your git repo url"
 ```
 * У корань атрыманнай дырэкторыі(дзе ляжыць *.git*) трэба пакласці копію файла *deploy.php*
 * У наладках рэпазіторыя https://github.com/<your_account>/<your_repository>/settings/hooks трэба дадаць url, па якім можна адчыніць ваш *deploy.php*
 * Выбраць "Just the push event"
 * Націснуць "Add Webhook".
 * Зараз сэрвер будзе аутаматычна выбираць усе змены, зробленныя на github.
 
