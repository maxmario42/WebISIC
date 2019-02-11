/*==============================================================*/
/* Nom de SGBD :  MySQL 5.0                                     */
/* Date de création :  11/02/2019 11:57:02                      */
/*==============================================================*/


drop table if exists AJOUTER;

drop table if exists APPARIER;

drop table if exists APPARTENIR;

drop table if exists PARTICIPER;

drop table if exists QUESTION;

drop table if exists QUESTIONNAIRE;

drop table if exists REGLES_GENERATION;

drop table if exists REGLES_QUESTIONNAIRE;

drop table if exists REPONSES_POSSIBLES;

drop table if exists REPONSE_CHOISIE;

drop table if exists SPECIFIER;

drop table if exists TAG;

drop table if exists TAGGER;

drop table if exists TYPE;

drop table if exists UTILISATEUR;

/*==============================================================*/
/* Table : AJOUTER                                              */
/*==============================================================*/
create table AJOUTER
(
   IDQ                  bigint not null,
   ID_QUEST             bigint not null,
   primary key (IDQ, ID_QUEST)
);

/*==============================================================*/
/* Table : APPARIER                                             */
/*==============================================================*/
create table APPARIER
(
   REP_ID_REPONSE       bigint not null,
   ID_REPONSE           bigint not null,
   primary key (REP_ID_REPONSE, ID_REPONSE)
);

/*==============================================================*/
/* Table : APPARTENIR                                           */
/*==============================================================*/
create table APPARTENIR
(
   IDRC                 bigint not null,
   ID_REPONSE           bigint not null,
   primary key (IDRC, ID_REPONSE)
);

/*==============================================================*/
/* Table : PARTICIPER                                           */
/*==============================================================*/
create table PARTICIPER
(
   ID                   bigint not null,
   IDQ                  bigint not null,
   primary key (ID, IDQ)
);

/*==============================================================*/
/* Table : QUESTION                                             */
/*==============================================================*/
create table QUESTION
(
   INTITULE             varchar(200) not null,
   ID_QUEST             bigint not null auto_increment,
   TYPEQ                varchar(20) not null,
   TEMPS_MAXIMAL        smallint,
   primary key (ID_QUEST)
);

/*==============================================================*/
/* Table : QUESTIONNAIRE                                        */
/*==============================================================*/
create table QUESTIONNAIRE
(
   IDQ                  bigint not null,
   ID                   bigint not null,
   TITRE                varchar(200) not null,
   ID_REGLES_QUEST      bigint not null,
   DESCRIPTION          char(255),
   ETAT                 char(255) not null,
   DATE_OUVERTURE       date not null,
   DATE_FERMETURE       date not null,
   MODE_ACCES           char(200),
   LIEN_HTTP            varchar(255) not null,
   primary key (IDQ)
);

/*==============================================================*/
/* Table : REGLES_GENERATION                                    */
/*==============================================================*/
create table REGLES_GENERATION
(
   REGLE                varchar(200) not null,
   ID_REGLE             bigint not null auto_increment,
   primary key (ID_REGLE)
);

/*==============================================================*/
/* Table : REGLES_QUESTIONNAIRE                                 */
/*==============================================================*/
create table REGLES_QUESTIONNAIRE
(
   TEMPS_TOTALE         smallint,
   REVENIR_ARRIERE      bool not null,
   ID_REGLES_QUEST      bigint not null auto_increment,
   PLUS                 int not null,
   MOINS                int,
   NEUTRE               int,
   primary key (ID_REGLES_QUEST)
);

/*==============================================================*/
/* Table : REPONSES_POSSIBLES                                   */
/*==============================================================*/
create table REPONSES_POSSIBLES
(
   ID_REPONSE           bigint not null auto_increment,
   ID_QUEST             bigint not null,
   ENONCE               varchar(200) not null,
   CORRECT              bool not null,
   COLONNE1OU2          smallint,
   primary key (ID_REPONSE)
);

/*==============================================================*/
/* Table : REPONSE_CHOISIE                                      */
/*==============================================================*/
create table REPONSE_CHOISIE
(
   ID_QUEST             bigint not null,
   IDRC                 bigint not null auto_increment,
   ID                   bigint not null,
   OKPASOK              bool not null,
   primary key (IDRC)
);

/*==============================================================*/
/* Table : SPECIFIER                                            */
/*==============================================================*/
create table SPECIFIER
(
   IDQ                  bigint not null,
   ID_REGLE             bigint not null,
   primary key (IDQ, ID_REGLE)
);

/*==============================================================*/
/* Table : TAG                                                  */
/*==============================================================*/
create table TAG
(
   TAG                  varchar(50) not null,
   primary key (TAG)
);

/*==============================================================*/
/* Table : TAGGER                                               */
/*==============================================================*/
create table TAGGER
(
   ID_QUEST             bigint not null,
   TAG                  varchar(50) not null,
   primary key (ID_QUEST, TAG)
);

/*==============================================================*/
/* Table : TYPE                                                 */
/*==============================================================*/
create table TYPE
(
   TYPEQ                varchar(20) not null,
   primary key (TYPEQ)
);

/*==============================================================*/
/* Table : UTILISATEUR                                          */
/*==============================================================*/
create table UTILISATEUR
(
   NOM                  char(100) not null,
   PRENOM               char(100) not null,
   TYPE_UTILISATEUR     char(100) not null,
   ID                   bigint not null auto_increment,
   MATRICULE            char(255),
   STATUT               varchar(200),
   MAIL_ENSEIGNANT      char(200),
   PROMO                char(100),
   ANNEE_DE_SORTIE      smallint,
   MAIL_ETUDIANT        char(200),
   primary key (ID)
);

/*==============================================================*/
/* Index : NOM_PRENOM                                           */
/*==============================================================*/
create unique index NOM_PRENOM on UTILISATEUR
(
   NOM,
   PRENOM
);

alter table AJOUTER add constraint FK_AJOUTER foreign key (IDQ)
      references QUESTIONNAIRE (IDQ) on delete restrict on update cascade;

alter table AJOUTER add constraint FK_AJOUTER2 foreign key (ID_QUEST)
      references QUESTION (ID_QUEST) on delete restrict on update cascade;

alter table APPARIER add constraint FK_APPARIER foreign key (REP_ID_REPONSE)
      references REPONSES_POSSIBLES (ID_REPONSE) on delete restrict on update cascade;

alter table APPARIER add constraint FK_APPARIER2 foreign key (ID_REPONSE)
      references REPONSES_POSSIBLES (ID_REPONSE) on delete restrict on update cascade;

alter table APPARTENIR add constraint FK_APPARTENIR foreign key (IDRC)
      references REPONSE_CHOISIE (IDRC) on delete restrict on update cascade;

alter table APPARTENIR add constraint FK_APPARTENIR2 foreign key (ID_REPONSE)
      references REPONSES_POSSIBLES (ID_REPONSE) on delete restrict on update cascade;

alter table PARTICIPER add constraint FK_PARTICIPER foreign key (ID)
      references UTILISATEUR (ID) on delete restrict on update cascade;

alter table PARTICIPER add constraint FK_PARTICIPER2 foreign key (IDQ)
      references QUESTIONNAIRE (IDQ) on delete restrict on update cascade;

alter table QUESTION add constraint FK_TYPER foreign key (TYPEQ)
      references TYPE (TYPEQ) on delete restrict on update cascade;

alter table QUESTIONNAIRE add constraint FK_CREER_GERER foreign key (ID)
      references UTILISATEUR (ID) on delete restrict on update cascade;

alter table QUESTIONNAIRE add constraint FK_REGLER_Q foreign key (ID_REGLES_QUEST)
      references REGLES_QUESTIONNAIRE (ID_REGLES_QUEST) on delete restrict on update cascade;

alter table REPONSES_POSSIBLES add constraint FK_ASSOCIER foreign key (ID_QUEST)
      references QUESTION (ID_QUEST) on delete restrict on update cascade;

alter table REPONSE_CHOISIE add constraint FK_CHOISIR foreign key (ID)
      references UTILISATEUR (ID) on delete restrict on update cascade;

alter table REPONSE_CHOISIE add constraint FK_PAR foreign key (ID_QUEST)
      references QUESTION (ID_QUEST) on delete restrict on update cascade;

alter table SPECIFIER add constraint FK_SPECIFIER foreign key (IDQ)
      references QUESTIONNAIRE (IDQ) on delete restrict on update cascade;

alter table SPECIFIER add constraint FK_SPECIFIER2 foreign key (ID_REGLE)
      references REGLES_GENERATION (ID_REGLE) on delete restrict on update cascade;

alter table TAGGER add constraint FK_TAGGER foreign key (ID_QUEST)
      references QUESTION (ID_QUEST) on delete restrict on update cascade;

alter table TAGGER add constraint FK_TAGGER2 foreign key (TAG)
      references TAG (TAG) on delete restrict on update cascade;

