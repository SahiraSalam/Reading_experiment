<?php

namespace Database\Seeders;

use App\Models\Passage;
use App\Models\PassageQuestion;
use App\Models\PassageQuestionOption;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PassageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        $passages = [
            [
                'text_name' => 'Passage 1: Standard Text',
                'topic' => 'Little Red Riding Hood',
                'content' => '
            <p>Once upon a time, there was a little village girl, the prettiest ever seen. Her mother doted on her, and her grandmother even more so.
            This good woman made her a little red riding hood, which suited her so well that everyone called her Little Red Riding Hood. One day, her
            mother baked some cakes and said to her, "Go, my dear, and see how your grandmother is doing, for I have heard she has been very ill. Take her
            a cake and this little pot of butter."</p>

            <p>Little Red Riding Hood set out at once for her grandmother’s house, which was in another village. As she walked through the woods, she met a wolf,
            who wanted to eat her but dared not because of some woodcutters working nearby. He asked her where she was going. The poor child, who did not know it
            was dangerous to stop and listen to a wolf, said, "I am going to see my grandmother and carry her a cake and a little pot of butter from my mother.</p>',
                'questions' => [
                    [
                        'title' => 'What is the primary reason the wolf does not immediately eat Little Red Riding Hood when he meets her in the woods?',
                        'options' => [
                            ['value' => 'A', 'text' => 'He is afraid of her red riding hood.'],
                            ['value' => 'B', 'text' => 'He is intimidated by the presence of woodcutters nearby.'],
                            ['value' => 'C', 'text' => 'He is waiting for her to lead him to her grandmothers house.'],
                            ['value' => 'D', 'text' => 'He is not hungry at the time'],
                        ]
                    ],
                    [
                        'title' => 'Why does Little Red Riding Hoods mother send her to visit her grandmother?',
                        'options' => [
                            ['value' => 'A', 'text' => 'To deliver a cake and a pot of butter as a gesture of goodwill.'],
                            ['value' => 'B', 'text' => 'To check on her grandmothers health, as she has been very ill'],
                            ['value' => 'C', 'text' => 'To keep her occupied while she prepares for a village celebration.'],
                            ['value' => 'D', 'text' => 'To teach her the importance of obedience and responsibility.'],
                        ]
                    ],
                    [
                        'title' => 'What does Little Red Riding Hoods red hood symbolize in the context of the story?',
                        'options' => [
                            ['value' => 'A', 'text' => 'Her innocence and vulnerability.'],
                            ['value' => 'B', 'text' => 'Her rebellious nature and independence.'],
                            ['value' => 'C', 'text' => ' Her wealth and high social status.'],
                            ['value' => 'D', 'text' => 'Her connection to the natural world.'],
                        ]
                    ],
                ]
            ],
            [
                'text_name' => 'Passage 2: Inter-Letter Spacing',
                'topic' => 'The Alchemist',
                'content' => "
            <p>The boy reached through to the Soul of the World, and saw that it was a part of the Soul of God. And he saw that the Soul
            of God was his own soul. And that he, a boy, could perform miracles. The desert was a great silence, and he had never felt so
             much a part of it. The dunes were changing, the winds were singing, and the boy felt that the desert was alive. He felt that
             the desert was aware of his presence, and that it welcomed him. The boy understood that, on the path to his Personal Legend,
             he was always in the right place at the right time. He was exactly where he was supposed to be. The boy remembered the old king’s
             words: \"When you want something, all the universe conspires in helping you to achieve it.\" He smiled. He was realizing that he was
             discovering the Language of the World. The desert, the wind, and the sun were all speaking to him, and he was beginning to understand.
             The boy felt a profound sense of peace. He knew that he was fulfilling his destiny, and that no matter what happened, he would always
             be able to find his way back to this feeling. The boy was no longer a boy. He was a man who had found his purpose.</p> ",

            'questions' => [
                    [
                        'title' => 'What does the boy realize about the Soul of the World?',
                        'options' => [
                            ['value' => 'A', 'text' => 'It is separate from the Soul of God.'],
                            ['value' => 'B', 'text' => 'It is a part of the Soul of God and his own soul.'],
                            ['value' => 'C', 'text' => 'It is an illusion created by the desert.'],
                            ['value' => 'D', 'text' => 'It is something only alchemists can understand.'],
                        ]
                    ],
                    [
                        'title' => 'What does the boy understand about his journey to his Personal Legend?',
                        'options' => [
                            ['value' => 'A', 'text' => 'He is often in the wrong place at the wrong time.'],
                            ['value' => 'B', 'text' => 'He is always in the right place at the right time.'],
                            ['value' => 'C', 'text' => 'He must rely solely on the alchemist’s guidance.'],
                            ['value' => 'D', 'text' => 'He must abandon his journey to find peace.'],
                        ]
                    ],
                    [
                        'title' => 'How does the boy feel about the desert?',
                        'options' => [
                            ['value' => 'A', 'text' => 'He feels isolated and afraid.'],
                            ['value' => 'B', 'text' => 'He feels it is alive and aware of his presence.'],
                            ['value' => 'C', 'text' => 'He feels it is a barrier to his Personal Legend.'],
                            ['value' => 'D', 'text' => 'He feels it is indifferent to his journey.'],
                        ]
                    ],
                ]
            ],
            [
                'text_name' => 'Passage 3: Inter-Line Spacing',
                'topic' => 'The Adventures of Pinocchio',
                'content' => "
            <p>Pinocchio, seeing that all hope was lost, closed his eyes and waited for the final blow. But just as the fisherman was
            about to throw him into the pan, a large dog entered the cave, attracted by the smell of frying fish. The dog, who was very
            hungry, began to bark so loudly that the fisherman turned around to see what was happening. In that moment, Pinocchio seized
            his chance. With a quick leap, he jumped out of the fisherman’s hands and ran toward the entrance of the cave. The fisherman,
            realizing what had happened, chased after him, but Pinocchio was too fast. The wooden boy ran as if his life depended on it,
            and soon he was out of the cave and into the open air. He did not stop running until he was sure he was safe. When he finally
            paused to catch his breath, he realized that he had escaped death once again. But he also knew that he could not keep relying
            on luck. He needed to be smarter and more careful if he wanted to survive in this dangerous world. Pinocchio sat down on a rock
            and began to think about his choices. He knew that he had made many mistakes, but he also knew that it was never too late to change.
            With a newfound determination, he decided to make better decisions from now on.</p>",

            'questions' => [
                    [
                        'title' => 'What happens just as the fisherman is about to throw Pinocchio into the pan?',
                        'options' => [
                            ['value' => 'A', 'text' => 'The fisherman changes his mind and lets Pinocchio go.'],
                            ['value' => 'B', 'text' => 'A large dog enters the cave, distracting the fisherman.'],
                            ['value' => 'C', 'text' => 'Pinocchio transforms into a real boy.'],
                            ['value' => 'D', 'text' => 'The cave collapses, trapping the fisherman.'],
                        ]
                    ],
                    [
                        'title' => 'How does Pinocchio escape from the fisherman?',
                        'options' => [
                            ['value' => 'A', 'text' => 'He uses magic to disappear.'],
                            ['value' => 'B', 'text' => 'He jumps out of the fisherman’s hands and runs away.'],
                            ['value' => 'C', 'text' => 'The dog attacks the fisherman, allowing Pinocchio to escape.'],
                            ['value' => 'D', 'text' => 'He convinces the fisherman to set him free.'],
                        ]
                    ],
                    [
                        'title' => 'What does Pinocchio realize after escaping from the cave?',
                        'options' => [
                            ['value' => 'A', 'text' => 'He can always rely on luck to save him.'],
                            ['value' => 'B', 'text' => 'He needs to be smarter and more careful to survive.'],
                            ['value' => 'C', 'text' => 'He should never trust anyone again.'],
                            ['value' => 'D', 'text' => 'He is invincible and cannot be harmed.'],
                        ]
                    ],
                ]

            ],
            [
                'text_name' => 'Passage 4: Inter-Letter & Line Spacing',
                'topic' => 'Atomic Habits',
                'content' => "
            <p>Habits are the compound interest of self-improvement. The same way that money multiplies through compound interest,
            the effects of your habits multiply as you repeat them. They seem to make little difference on any given day, yet the
            impact they deliver over the months and years can be enormous. It is only when looking back two, five, or perhaps ten
            years later that the value of good habits and the cost of bad ones becomes strikingly apparent. Small changes often appear
            to make no difference until you cross a critical threshold. The most powerful outcomes of any compounding process are delayed.
            You need to be patient. An atomic habit is a little habit that is part of a larger system. Just as atoms are the building blocks
            of molecules, atomic habits are the building blocks of remarkable results. If you want better results, then forget about setting goals.
            Focus on your system instead. You do not rise to the level of your goals. You fall to the level of your systems</p>",

            'questions' => [
                    [
                        'title' => 'What does the author compare habits to in this passage?',
                        'options' => [
                            ['value' => 'A', 'text' => 'The stock market'],
                            ['value' => 'B', 'text' => 'Compound interest'],
                            ['value' => 'C', 'text' => 'A ticking clock'],
                            ['value' => 'D', 'text' => 'A ladder'],
                        ]
                    ],
                    [
                        'title' => 'What is the primary message about the impact of habits over time?',
                        'options' => [
                            ['value' => 'A', 'text' => 'Habits have an immediate and noticeable effect.'],
                            ['value' => 'B', 'text' => 'Habits only matter if they are large and dramatic.'],
                            ['value' => 'C', 'text' => 'The effects of habits multiply and become significant over time.'],
                            ['value' => 'D', 'text' => 'Habits are irrelevant to long-term success.'],
                        ]
                    ],
                    [
                        'title' => 'What does Clear mean by "crossing a critical threshold"?',
                        'options' => [
                            ['value' => 'A', 'text' => 'Achieving a major life goal'],
                            ['value' => 'B', 'text' => 'Reaching a point where small changes create significant results'],
                            ['value' => 'C', 'text' => 'Giving up on a habit that isn’t working'],
                            ['value' => 'D', 'text' => 'Starting a completely new system'],
                        ]
                    ],
                ]
            ]
        ];


        foreach ($passages as $passage) {
            $passageStore = new Passage();
            $passageStore->text_name = $passage['text_name'];
            $passageStore->topic = $passage['topic'];
            $passageStore->content = $passage['content'];
            $passageStore->save();

            if (!empty($passage['questions'])) {
                foreach ($passage['questions'] as $question) {
                    $passageQuestions = new PassageQuestion();
                    $passageQuestions->title = $question['title'];
                    $passageQuestions->passage_id = $passageStore->id;
                    $passageQuestions->save();

                    foreach ($question['options'] as $index => $option) {
                        $passageQuestionOption = new PassageQuestionOption();
                        $passageQuestionOption->passage_question_id = $passageQuestions->id;
                        $passageQuestionOption->passage_id = $passageStore->id;
                        $passageQuestionOption->title = $option['text'];
                        $passageQuestionOption->value = $option['value'];
                        $passageQuestionOption->save();
                    }


                }

            }

            $this->command->info($passage['text_name'] . ' created successfully.');
        }


    }
}
