/*==============================================================*/
/* Nom de SGBD :  MySQL 5.0                                     */
/* Date de création :  04/04/2018 14:00:04                      */
/*==============================================================*/


drop table if exists AGENT;

drop table if exists COULEUR;

drop table if exists ETAPE;

drop table if exists ETUDIANT;

drop table if exists FONCTION;

drop table if exists GROUPE;

drop table if exists GROUPE_USER;

drop table if exists IP;

drop table if exists LIEU;

drop table if exists LOG_CONNECTION;

drop table if exists MARQUE;

drop table if exists MODELE;

drop table if exists PARTICIPANTS;

drop table if exists PROMOTION;

drop table if exists TRAJET;

drop table if exists TRAJET_MODERATOR;

drop table if exists TYPE_TRAJET;

drop table if exists UNITE;

drop table if exists USER;

drop table if exists VEHICULE;

drop table if exists VEHICULE_TRAJET;

/*==============================================================*/
/* Table : AGENT                                                */
/*==============================================================*/
create table AGENT
(
   ID_USER              int not null,
   ID_LIEU              int,
   ID_UNITE             int not null,
   ID_FONCTION          int,
   primary key (ID_USER)
);

/*==============================================================*/
/* Table : COULEUR                                              */
/*==============================================================*/
create table COULEUR
(
   ID_COULEUR           int not null auto_increment,
   NOM_COULEUR          varchar(50) not null,
   primary key (ID_COULEUR)
);

/*==============================================================*/
/* Table : ETAPE                                                */
/*==============================================================*/
create table ETAPE
(
   ID_TRAJET            int not null,
   ID_LIEU              int not null,
   HEURE                datetime not null,
   primary key (ID_TRAJET, ID_LIEU)
);

/*==============================================================*/
/* Table : ETUDIANT                                             */
/*==============================================================*/
create table ETUDIANT
(
   ID_USER              int not null,
   ID_PROMOTION         int not null,
   primary key (ID_USER)
);

/*==============================================================*/
/* Table : FONCTION                                             */
/*==============================================================*/
create table FONCTION
(
   ID_FONCTION          int not null auto_increment,
   NOM_FONCTION         varchar(50) not null,
   primary key (ID_FONCTION)
);

/*==============================================================*/
/* Table : GROUPE                                               */
/*==============================================================*/
create table GROUPE
(
   ID_GROUPE            int not null auto_increment,
   NOM_GROUPE           varchar(50) not null,
   primary key (ID_GROUPE)
);

/*==============================================================*/
/* Table : GROUPE_USER                                          */
/*==============================================================*/
create table GROUPE_USER
(
   ID_GROUPE            int not null,
   ID_USER              int not null,
   primary key (ID_GROUPE, ID_USER)
);

/*==============================================================*/
/* Table : IP                                                   */
/*==============================================================*/
create table IP
(
   ID_IP                int not null auto_increment,
   IP                   varchar(15) not null,
   IP_BANNI             bool not null,
   primary key (ID_IP)
);

/*==============================================================*/
/* Table : LIEU                                                 */
/*==============================================================*/
create table LIEU
(
   ID_LIEU              int not null auto_increment,
   LAT                  decimal(10,6) not null,
   LON                  decimal(10,6) not null,
   ADRESSE              varchar(255) not null,
   NOM_LIEU             varchar(50) not null,
   primary key (ID_LIEU)
);

/*==============================================================*/
/* Table : LOG_CONNECTION                                       */
/*==============================================================*/
create table LOG_CONNECTION
(
   ID_LOG_CONNECTION    int not null auto_increment,
   ID_IP                int not null,
   DATE                 datetime not null,
   primary key (ID_LOG_CONNECTION)
);

/*==============================================================*/
/* Table : MARQUE                                               */
/*==============================================================*/
create table MARQUE
(
   ID_MARQUE            int not null auto_increment,
   NOM_MARQUE           varchar(50) not null,
   primary key (ID_MARQUE)
);

/*==============================================================*/
/* Table : MODELE                                               */
/*==============================================================*/
create table MODELE
(
   ID_MODELE            int not null auto_increment,
   ID_MARQUE            int not null,
   ANNEE                int not null,
   NOM_MODELE           varchar(50) not null,
   primary key (ID_MODELE)
);

/*==============================================================*/
/* Table : PARTICIPANTS                                         */
/*==============================================================*/
create table PARTICIPANTS
(
   ID_USER              int not null,
   ID_TRAJET            int not null,
   primary key (ID_USER, ID_TRAJET)
);

/*==============================================================*/
/* Table : PROMOTION                                            */
/*==============================================================*/
create table PROMOTION
(
   ID_PROMOTION         int not null auto_increment,
   NOM_PROMOTION        varchar(15) not null,
   TYPE_PROMOTION       varchar(15) not null,
   primary key (ID_PROMOTION)
);

/*==============================================================*/
/* Table : TRAJET                                               */
/*==============================================================*/
create table TRAJET
(
   ID_TRAJET            int not null auto_increment,
   ID_TYPE_TRAJET       int not null,
   ID_USER              int not null,
   PLACE                smallint not null,
   BLOQUER              bool not null,
   primary key (ID_TRAJET)
);

/*==============================================================*/
/* Table : TRAJET_MODERATOR                                     */
/*==============================================================*/
create table TRAJET_MODERATOR
(
   ID_TRAJET            int not null,
   ID_USER              int not null,
   primary key (ID_TRAJET, ID_USER)
);

/*==============================================================*/
/* Table : TYPE_TRAJET                                          */
/*==============================================================*/
create table TYPE_TRAJET
(
   ID_TYPE_TRAJET       int not null auto_increment,
   NOM_TYPE             varchar(255) not null,
   primary key (ID_TYPE_TRAJET)
);

/*==============================================================*/
/* Table : UNITE                                                */
/*==============================================================*/
create table UNITE
(
   ID_UNITE             int not null auto_increment,
   NOM_UNITE            varchar(255) not null,
   primary key (ID_UNITE)
);

/*==============================================================*/
/* Table : USER                                                 */
/*==============================================================*/
create table USER
(
   ID_USER              int not null auto_increment,
   ID_LOG_CONNECTION    int not null,
   NOM                  varchar(50) not null,
   PRENOM               varchar(50) not null,
   EMAIL                varchar(255) not null,
   TELEPHONE            varchar(12) not null,
   PASSWORD             varchar(255) not null,
   ADMIN                bool not null,
   PSEUDO               varchar(50) not null,
   BANNI                bool not null,
   primary key (ID_USER)
);

/*==============================================================*/
/* Table : VEHICULE                                             */
/*==============================================================*/
create table VEHICULE
(
   ID_VEHICULE          int not null auto_increment,
   ID_COULEUR           int not null,
   ID_MODELE            int not null,
   ID_USER              int not null,
   primary key (ID_VEHICULE)
);

/*==============================================================*/
/* Table : VEHICULE_TRAJET                                      */
/*==============================================================*/
create table VEHICULE_TRAJET
(
   ID_VEHICULE          int not null,
   ID_TRAJET            int not null,
   primary key (ID_VEHICULE, ID_TRAJET)
);

alter table AGENT add constraint FK_FONCTION_AGENT foreign key (ID_FONCTION)
      references FONCTION (ID_FONCTION) on delete restrict on update restrict;

alter table AGENT add constraint FK_HERITAGE_1 foreign key (ID_USER)
      references USER (ID_USER) on delete restrict on update restrict;

alter table AGENT add constraint FK_LIEU_AGENT foreign key (ID_LIEU)
      references LIEU (ID_LIEU) on delete restrict on update restrict;

alter table AGENT add constraint FK_UNITE_AGENT foreign key (ID_UNITE)
      references UNITE (ID_UNITE) on delete restrict on update restrict;

alter table ETAPE add constraint FK_ETAPE foreign key (ID_TRAJET)
      references TRAJET (ID_TRAJET) on delete restrict on update restrict;

alter table ETAPE add constraint FK_ETAPE2 foreign key (ID_LIEU)
      references LIEU (ID_LIEU) on delete restrict on update restrict;

alter table ETUDIANT add constraint FK_HERITAGE_2 foreign key (ID_USER)
      references USER (ID_USER) on delete restrict on update restrict;

alter table ETUDIANT add constraint FK_USER_PROMOTION foreign key (ID_PROMOTION)
      references PROMOTION (ID_PROMOTION) on delete restrict on update restrict;

alter table GROUPE_USER add constraint FK_GROUPE_USER foreign key (ID_GROUPE)
      references GROUPE (ID_GROUPE) on delete restrict on update restrict;

alter table GROUPE_USER add constraint FK_GROUPE_USER2 foreign key (ID_USER)
      references USER (ID_USER) on delete restrict on update restrict;

alter table IP add unique (IP);

alter table LOG_CONNECTION add constraint FK_IP_CONNECTION foreign key (ID_IP)
      references IP (ID_IP) on delete restrict on update restrict;

alter table MODELE add constraint FK_MARQUE_MODELE foreign key (ID_MARQUE)
      references MARQUE (ID_MARQUE) on delete restrict on update restrict;

alter table PARTICIPANTS add constraint FK_PARTICIPANTS foreign key (ID_USER)
      references USER (ID_USER) on delete restrict on update restrict;

alter table PARTICIPANTS add constraint FK_PARTICIPANTS2 foreign key (ID_TRAJET)
      references TRAJET (ID_TRAJET) on delete restrict on update restrict;

alter table TRAJET add constraint FK_TRAJET_CREATOR foreign key (ID_USER)
      references USER (ID_USER) on delete restrict on update restrict;

alter table TRAJET add constraint FK_TRAJET_TYPE foreign key (ID_TYPE_TRAJET)
      references TYPE_TRAJET (ID_TYPE_TRAJET) on delete restrict on update restrict;

alter table TRAJET_MODERATOR add constraint FK_TRAJET_MODERATOR foreign key (ID_TRAJET)
      references TRAJET (ID_TRAJET) on delete restrict on update restrict;

alter table TRAJET_MODERATOR add constraint FK_TRAJET_MODERATOR2 foreign key (ID_USER)
      references USER (ID_USER) on delete restrict on update restrict;

alter table USER add constraint FK_CONNECTION_CREATION foreign key (ID_LOG_CONNECTION)
      references LOG_CONNECTION (ID_LOG_CONNECTION) on delete restrict on update restrict;

alter table USER add unique (EMAIL);

alter table VEHICULE add constraint FK_COULEUR_VOITURE foreign key (ID_COULEUR)
      references COULEUR (ID_COULEUR) on delete restrict on update restrict;

alter table VEHICULE add constraint FK_MODELE_VOITURE foreign key (ID_MODELE)
      references MODELE (ID_MODELE) on delete restrict on update restrict;

alter table VEHICULE add constraint FK_VEHICULE_USER foreign key (ID_USER)
      references USER (ID_USER) on delete restrict on update restrict;

alter table VEHICULE_TRAJET add constraint FK_VEHICULE_TRAJET foreign key (ID_VEHICULE)
      references VEHICULE (ID_VEHICULE) on delete restrict on update restrict;

alter table VEHICULE_TRAJET add constraint FK_VEHICULE_TRAJET2 foreign key (ID_TRAJET)
      references TRAJET (ID_TRAJET) on delete restrict on update restrict;
