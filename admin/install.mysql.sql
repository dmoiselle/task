CREATE TABLE IF NOT EXISTS #__tasks (
  id int(4) NOT NULL auto_increment,
  title text NOT NULL,
  datedue date NOT NULL,
  description varchar(255),
  PRIMARY KEY  (id)
);


