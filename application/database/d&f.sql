/*==============================================================*/
/* Nom de SGBD :  MySQL 5.0                                     */
/* Date de création :  08/04/2016 12:21:41                      */
/*==============================================================*/


drop table if exists abonne;

drop table if exists articleRubrique;

drop table if exists compteur;

drop table if exists images;

drop table if exists newsletter;

drop table if exists recevoir;

drop table if exists rubrique;

drop table if exists textSite;

drop table if exists user;

/*==============================================================*/
/* Table : abonne                                               */
/*==============================================================*/
create table abonne
(
   idAbonne             int(6) not null auto_increment,
   nom                  text not null,
   prenom               text not null,
   mail                 text not null,
   primary key (idabonne)
);

/*==============================================================*/
/* Table : articlerubrique                                      */
/*==============================================================*/
create table articlerubrique
(
   idArticleRubrique    int(3) not null auto_increment,
   idRubrique           int(3),
   textRubrique         text not null,
   primary key (idarticleRubrique)
);

/*==============================================================*/
/* Table : compteur                                             */
/*==============================================================*/
create table compteur
(
   ipPersonne           text not null
);

/*==============================================================*/
/* Table : images                                               */
/*==============================================================*/
create table images
(
   idImages             int(3) not null auto_increment,
   idRubrique           int(3),
   idArticleRubrique    int(3),
   idTextSite           int(3),
   titre                text not null,
   description          text,
   primary key (idImages)
);

/*==============================================================*/
/* Table : newsletter                                           */
/*==============================================================*/
create table newsletter
(
   idNewsletter         int(6) not null auto_increment,
   idUser               int(3),
   titre                text not null,
   texte                text not null,
   primary key (idNewsletter)
);

/*==============================================================*/
/* Table : recevoir                                             */
/*==============================================================*/
create table recevoir
(
   idNewsletter         int(6) not null,
   idAbonne             int(6) not null,
   primary key (idNewsletter, idAbonne)
);

/*==============================================================*/
/* Table : rubrique                                             */
/*==============================================================*/
create table rubrique
(
   idRubrique           int(3) not null auto_increment,
   idUser               int(3),
   nomRubrique          text not null,
   descriptionRubrique  text not null,
   primary key (idRubrique)
);

/*==============================================================*/
/* Table : textsite                                             */
/*==============================================================*/
create table textSite
(
   idTextSite           int(3) not null auto_increment,
   idUser               int(3),
   titreTextSite        text not null,
   textSite             text not null,
   primary key (idTextSite)
);

/*==============================================================*/
/* Table : user                                                 */
/*==============================================================*/
create table user
(
   idUser               int(3) not null auto_increment,
   nom                  text not null,
   prenom               text not null,
   mail                 text not null,
   mdp                  text not null,
   primary key (idUser)
);

alter table articleRubrique add constraint fk_associer foreign key (idRubrique)
      references rubrique (idRubrique) on delete restrict on update restrict;

alter table images add constraint fk_afficher foreign key (idarticlerubrique)
      references articleRubrique (idArticleRubrique) on delete restrict on update restrict;

alter table images add constraint fk_decorer foreign key (idTextSite)
      references textSite (idTextSite) on delete restrict on update restrict;

alter table images add constraint fk_illustrer foreign key (idRubrique)
      references rubrique (idRubrique) on delete restrict on update restrict;

alter table newsletter add constraint fk_envoyer foreign key (idUser)
      references user (idUser) on delete restrict on update restrict;

alter table recevoir add constraint fk_recevoir foreign key (idNewsletter)
      references newsletter (idNewsletter) on delete restrict on update restrict;

alter table recevoir add constraint fk_recevoir2 foreign key (idAbonne)
      references abonne (idAbonne) on delete restrict on update restrict;

alter table rubrique add constraint fk_posseder foreign key (idUser)
      references user (idUser) on delete restrict on update restrict;

alter table textSite add constraint fk_ecrire foreign key (idUser)
      references user (idUser) on delete restrict on update restrict;

