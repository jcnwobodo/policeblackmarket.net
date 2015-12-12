<?php
/**
 * Phoenix Laboratories NG.
 * Author: J. C. Nwobodo (jc.nwobodo@gmail.com)
 * Project: PoliceBlackMarket
 * Date:    12/10/2015
 * Time:    3:09 AM
 **/

function getQuotes()
{
    $QUOTES = array();

    $QUOTES[] = array('If someone puts their hands on you make sure they never put their hands on anybody else again.', 'Malcolm X');
    $QUOTES[] = array('When you have police officers who abuse citizens, you erode public confidence in law enforcement. That makes the job of good police officers unsafe', 'Mary Frances Berry');
    $QUOTES[] = array('Unreasonable force is illegal. The force used has to be reasonable under the circumstances to protect the police officers and the public', 'Kenneth Eade, Unreasonable Force');
    $QUOTES[] = array('I have interacted with the police complaints and internal affairs division twice and both times I came away with the opinion that I was dealing with a blatantly corrupt group of people.', 'Steven Magee');
    $QUOTES[] = array('I know the police cause you trouble, they cause trouble everywhere. But when you die and go to heaven, You find no policeman there', ' Woody Guthrie');
    $QUOTES[] = array('A cop is closer to a garbage man than he is to a lawyer. The cop isn’t in the middle of the two—he’s on top, with the lawyer being well below the garbage man.', ' Jarod Kintz, The Titanic would never have sunk if it were made out of a sink.');
    $QUOTES[] = array('Whether the mask is labeled fascism, democracy, or dictatorship of the proletariat, our great adversary remains the apparatus—the bureaucracy, the police, the military. Not the one facing us across the frontier of the battle lines, which is not so much our enemy as our brothers\' enemy, but the one that calls itself our protector and makes us its slaves. No matter what the circumstances, the worst betrayal will always be to subordinate ourselves to this apparatus and to trample underfoot, in its service, all human values in ourselves and in others.', 'Simone Weil');

    return $QUOTES;
}

function getRandomQuote()
{
    $quotes = getQuotes();
    if(is_array($quotes)){
        $index = rand(0, sizeof($quotes)-1);
        return $quotes[$index];
    }
}