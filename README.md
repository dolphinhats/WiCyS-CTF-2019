# Steal The Steel CTF

*Created by Dr. Vitaly Ford, Amela Gjishti, Konstantin Menako, and Daniel Tyler for the Women In CyberSecurity (WiCyS) 2019 conference.*

More documentation in the works, please check back.

## Requirements

```
docker docker-compose git
```

## Deployment

This project is fairly easy to deploy, simply run [`build.sh`](/build.sh) which will

1. Clone [CTFd](https://github.com/CTFd/CTFd) into the directory `ctfd/`
2. Generate a required crypto key for CTFd.
3. Run `docker-compose up` which will build and start the CTFd instance and all challenges.

Once CTFd has started, you may navigate to `localhost:80` in order to configure the challenges. 

When you log in to the admin portal, you can navigate to Settings and select Export. In the main directory of this repository, you will find a file called backup.2019-04-10.zip that you can export in order to get the flags, hints, categories, etc. to be added to the CTFd platform. Later on, you can change the flags yourself in CTFd (but don't forget to change those in the Challenge directories accordingly).

Contact if you have any questions/concerns/suggestions/contributions: Vitaly Ford (fordv@arcadia.edu).
