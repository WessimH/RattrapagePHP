# SN1 EPSI – Projet PHP/MySQL - Rattrapage

Vous devez réaliser un **extranet pour une société de bricolage à domicile**. Cette société emploie des intervenants capables de faire de la plomberie, de l’électricité et d’autres petits travaux au domicile des particuliers.

## Objectifs:

Vous devez réaliser une interface permettant à l’intervenant, après la réception d’une demande, de préparer son intervention. Il doit choisir le véhicule qu’il va prendre parmi les véhicules disponibles de la société. Puis il doit sélectionner le matériel qu’il amène avec lui parmi le matériel disponible dans le stock (et pas déjà parti en intervention avec un autre).

## Caractéristiques:

- Un **client** est caractérisé par son nom, son prénom, email et/ou numéro de téléphone, et son adresse.
- L'**intervenant** est caractérisé par son matricule, son nom et son prénom.
- Un **véhicule** est caractérisé par son immatriculation, sa marque, son modèle.
- Un **matériel** est caractérisé par un libellé, une marque, un modèle et parfois un numéro de série.
- L'**intervention**, en plus de son lien à un intervenant, un client, un véhicule et du matériel, contient un champ texte de commentaire et bien sûr la date.

## Procédures:

À son retour, l'intervenant doit clôturer l'intervention. Le véhicule et le matériel redeviennent disponibles pour les autres intervenants.

Une **administration sécurisée séparée** doit permettre de gérer les intervenants, les véhicules et le matériel en stock. Cette administration ne sera hébergée que sur réseau local, et ne nécessite pas de sécurisation d’accès pour le moment.

Un **historique des interventions** doit être conservé.

## Questions:

1. Élaborez la base de données dans MySQL.
2. Entrez manuellement des données de test dans chacune des tables (au moins une ligne par table).
3. En PHP, développez les pages permettant d’ajouter, supprimer ou modifier les interventions.

## Livrables:

Rendez un zip de votre code et un export de votre BDD : [Formulaire de soumission](https://forms.gle/HcmGanpH2ygQeRb26)

**Attention**, je le rappelle : ce travail est un travail individuel. Chacun d’entre vous doit travailler seul. Tout manquement à ce principe sera sanctionné d’un 0.

[Formulaire de soumission](https://forms.gle/HcmGanpH2ygQeRb26)

---

Please note that the text was directly translated from the document and some adaptations were made to fit Markdown syntax.