# Dictionnaire de données

## Tâches (`tasks`)

| Champ      | Type        | Spécificités                                    | Description                                        |
| ---------- | ----------- | ----------------------------------------------- | -------------------------------------------------- |
| id         | INT         | PRIMARY KEY, NOT NULL, UNSIGNED, AUTO_INCREMENT | L'identifiant de notre tâche                       |
| name       | VARCHAR(64) | NOT NULL                                        | Le nom de la tâche                                 |
| status     | TINYINT(1)  | NOT NULL, DEFAULT 0                             | La visibilité de la tâche (0=current, 1=archived)  |
| completion | TINYINT(1)  | NOT NULL, DEFAULT 0                             | Le statut de la tâche (0=in progress, 1=completed) |
| progress   | INT(1)      | NOT NULL, DEFAULT 0                             | Progression de la tâche                            |
| created_at | TIMESTAMP   | NOT NULL, DEFAULT CURRENT_TIMESTAMP             | La date de création de la tâche                    |
| updated_at | TIMESTAMP   | NULL                                            | La date de la dernière mise à jour de la tâche     |
| category   | entity      | NULL                                            | La catégorie (autre entité) de la tâche            |

## Catégories (`categories`)

| Champ      | Type         | Spécificités                                    | Description                                                              |
| ---------- | ------------ | ----------------------------------------------- | ------------------------------------------------------------------------ |
| id         | INT          | PRIMARY KEY, NOT NULL, UNSIGNED, AUTO_INCREMENT | L'identifiant de la catégorie                                            |
| name       | VARCHAR(64)  | NOT NULL                                        | Le nom de la catégorie                                                   |
| created_at | TIMESTAMP    | DEFAULT CURRENT_TIMESTAMP                       | La date de création de la catégorie                                      |
| updated_at | TIMESTAMP    | NULL                                            | La date de la dernière mise à jour de la catégorie                       |
