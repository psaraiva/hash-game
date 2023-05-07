# I am?

Hash game draft to use minicli lib. =P

# How it works?
The player choose a position and play.

# Install and play

- Install #1 `docker-compose up --build -d`;
- Install #1 `docker exec -it hash-game composer update`;
- Check command help `docker exec -it hash-game ./minicli help`;
- Play: Instructions `docker exec -it hash-game ./minicli game main`;
- Play: Player, choose a position `docker exec -it hash-game ./minicli game main player=X position=e`;
- That's all, folks.

# This is complete?

No, but i have some ideas:
- Create identifier for game;
- Create command start and finish;
- Use sqLite to save;

# Output
Instruction
```
+-----------------------------+
|Instructions:                |
|Use X or O to value of player|
+-----------------------------+
|          Positions          |
|            A|B|C            |
|            -+-+-            |
|            D|E|F            |
|            -+-+-            |
|            G|H|I            |
+-----------------------------+
```

Game:
```
+---------+
|.:GAME!:.|
+---------+
    | |
   -+-+-
    |X|
   -+-+-
    | |
+---------+
```

# More of Minicli

Please check [the official documentation](https://docs.minicli.dev) for more information on how to use this application template.
