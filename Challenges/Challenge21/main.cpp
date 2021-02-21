#include <iostream>
#include <string.h>
#include <stdio.h>
#include "main.h"

using namespace std;

int main(int argc, char **argv)
{
    // char actual_password[10] = "HelloWorl";
    char check = 'F';
    char pass[10];
    strcpy(pass, argv[1]);
    if (!strcmp(pass, ACTUAL_PASS))
    {
        check = 'T';
    }

    cout << (check == 'T' ? FLAG : "Failed") << endl;

    return 0;
}
