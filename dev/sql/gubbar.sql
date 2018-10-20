USE c9;

DROP TABLE IF EXISTS gubbar;

CREATE TABLE gubbar (
    id INT(11) NOT NULL AUTO_INCREMENT,
    team VARCHAR(255) NOT NULL,
    name VARCHAR(255) NOT NULL,
    info TEXT NOT NULL,
    img TEXT NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

INSERT INTO gubbar VALUES
    (null, "PanOceania", "PanOceania Starter Pack", "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae a sint, consequatur soluta tenetur dolores tempora. Cumque obcaecati unde provident vero. Itaque sit expedita tempora, magnam dignissimos natus! Alias, tempore.", "panoceania-starter-pack.jpg"),
    (null, "PanOceania", "Seraph", "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae a sint, consequatur soluta tenetur dolores tempora. Cumque obcaecati unde provident vero. Itaque sit expedita tempora, magnam dignissimos natus! Alias, tempore.", "pano-seraphs-military-order-armored-cavalry.jpg"),
    (null, "PanOceania", "Clausewitz Uhlan & Acontecimento Tikbalang", "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae a sint, consequatur soluta tenetur dolores tempora. Cumque obcaecati unde provident vero. Itaque sit expedita tempora, magnam dignissimos natus! Alias, tempore.", "pano-stingray-3-series-clausewitz-uhlans-and-acontecimento-tikbalangs.jpg"),
    (null, "PanOceania", "PanOceania Fusiliers", "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae a sint, consequatur soluta tenetur dolores tempora. Cumque obcaecati unde provident vero. Itaque sit expedita tempora, magnam dignissimos natus! Alias, tempore.", "pano-fusiliers.jpg"),
    (null, "Combined Army", "Combined Army Starter Pack", "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae a sint, consequatur soluta tenetur dolores tempora. Cumque obcaecati unde provident vero. Itaque sit expedita tempora, magnam dignissimos natus! Alias, tempore.", "ca-starter-pack.jpg"),
    (null, "Combined Army", "Suryats Assault Heavy Infantry", "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae a sint, consequatur soluta tenetur dolores tempora. Cumque obcaecati unde provident vero. Itaque sit expedita tempora, magnam dignissimos natus! Alias, tempore.", "ca-suryats-assault-heavy-infantry.jpg"),
    (null, "Combined Army", "Fraacta Drop Unit", "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae a sint, consequatur soluta tenetur dolores tempora. Cumque obcaecati unde provident vero. Itaque sit expedita tempora, magnam dignissimos natus! Alias, tempore.", "ca-fraacta-drop-unit-spitfire.jpg"),
    (null, "Combined Army", "Overdron Batroids", "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae a sint, consequatur soluta tenetur dolores tempora. Cumque obcaecati unde provident vero. Itaque sit expedita tempora, magnam dignissimos natus! Alias, tempore.", "ca-overdron-batroids.jpg");