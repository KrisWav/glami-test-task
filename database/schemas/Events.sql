CREATE TABLE `Event`
(
    `eventId` INTEGER PRIMARY KEY ASC,
    `type`    VARCHAR(255) NOT NULL,
    `created` TIMESTAMP    NOT NULL
);
CREATE INDEX created ON Event (created);
