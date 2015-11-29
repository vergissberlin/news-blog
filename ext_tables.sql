CREATE TABLE be_users (
	profile_pid int(11) unsigned default NULL,
	abstract text,
	abstract_content int(11) unsigned default NULL,
	
	KEY profile (profile_pid)
);

CREATE TABLE tx_news_domain_model_news (
	author_id int(11) unsigned default NULL,
	
	KEY author (author_id)
);