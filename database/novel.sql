-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 01, 2023 at 07:59 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `novel`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(255) NOT NULL,
  `nama_admin` varchar(255) NOT NULL,
  `email_admin` varchar(255) NOT NULL,
  `password` varchar(20) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `update_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `chapters`
--

CREATE TABLE `chapters` (
  `id` int(255) NOT NULL,
  `novel_id` varchar(255) NOT NULL,
  `chapter_number` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `chapters`
--

INSERT INTO `chapters` (`id`, `novel_id`, `chapter_number`, `title`, `created_at`, `updated_at`) VALUES
(1, '1', '1', 'Bab 1', '2023-11-25 12:52:57', '2023-11-25 12:52:57'),
(3, '1', '2', 'bab 2', '2023-08-31 00:23:50', '2023-08-31 07:23:50'),
(4, '1', '3', 'bab 3', '2023-09-08 19:44:16', '2023-08-31 07:38:16'),
(6, '2', '1', 'bab 1', '2023-11-01 23:30:35', '2023-11-02 06:30:35');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `novels`
--

CREATE TABLE `novels` (
  `id` int(255) NOT NULL,
  `cover_image` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `genre` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `sinopsis` longtext NOT NULL,
  `status_favorit` int(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `novels`
--

INSERT INTO `novels` (`id`, `cover_image`, `title`, `genre`, `author`, `sinopsis`, `status_favorit`, `created_at`, `updated_at`) VALUES
(1, 'buku1.png', 'Adventures of Huckleberry Finn', 'Petualangan', 'Mark Twain', 'The drifting journey of Huck and his friend Jim, a runaway slave, down the Mississippi River on their raft may be one of the most enduring images of escape and freedom in all of American literature. Although the society it satirized was already history at the time of publication, the book was quite controversial, and has remained so to this day.', 1, '2023-11-12 16:09:08', '2023-10-31 05:53:42'),
(2, 'buku2.png', 'Buku 3', 'Komedi', 'Ahmad', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus harum inventore ad omnis adipisci, voluptates libero sunt ut eveniet corrupti vitae perspiciatis tenetur quo alias id corporis, pariatur veniam ducimus? Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus harum inventore ad omnis adipisci, voluptates libero sunt ut eveniet corrupti vitae perspiciatis tenetur quo alias id corporis, pariatur veniam ducimus?', 0, '2023-10-23 19:47:33', '2023-10-23 19:47:33');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(255) NOT NULL,
  `chapter_id` varchar(255) NOT NULL,
  `page_number` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `bookmark_text` longtext DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `chapter_id`, `page_number`, `content`, `bookmark_text`, `created_at`, `updated_at`) VALUES
(1, '1', '1', ' <p>  YOU don’t know about me without you have read a book by the name of The\r\nAdventures of Tom Sawyer; but that ain’t no matter. That book was made by\r\nMr. Mark Twain, and he told the truth, mainly. There was things which he\r\nstretched, but mainly he told the truth. That is nothing. I never seen anybody\r\nbut lied one time or another, without it was Aunt Polly, or the widow, or maybe\r\nMary. Aunt Polly—Tom’s Aunt Polly, she is—and Mary, and the Widow\r\nDouglas is all told about in that book, which is mostly a true book, with some\r\nstretchers, as I said before.\r\n</p>\r\n    \r\n\r\n<p>Now the way that the book winds up is this: Tom and me found the money\r\nthat the robbers hid in the cave, and it made us rich. We got six thousand dollars\r\napiece—all gold. It was an awful sight of money when it was piled up. Well,\r\nJudge Thatcher he took it and put it out at interest, and it fetched us a dollar a\r\nday apiece all the year round—more than a body could tell what to do with. The\r\nWidow Douglas she took me for her son, and allowed she would sivilize me; but\r\nit was rough living in the house all the time, considering how dismal regular and\r\ndecent the widow was in all her ways; and so when I couldn’t stand it no longer I\r\nlit out. I got into my old rags and my sugar-hogshead again, and was free and\r\nsatisfied. But Tom Sawyer he hunted me up and said he was going to start a\r\nband of robbers, and I might join if I would go back to the widow and be\r\nrespectable. So I went back.\r\n</p>', 'Now the way that the book winds up is this: Tom and', '2023-11-16 07:50:53', '2023-11-16 07:50:53'),
(2, '3', '1', '<p> WE went tiptoeing along a path amongst the trees back towards the end of the\r\nwidow’s garden, stooping down so as the branches wouldn’t scrape our heads.\r\nWhen we was passing by the kitchen I fell over a root and made a noise. We\r\nscrouched down and laid still. Miss Watson’s big nigger, named Jim, was setting\r\nin the kitchen door; we could see him pretty clear, because there was a light\r\nbehind him. He got up and stretched his neck out about a minute, listening.\r\nThen he says:\r\n </p>\r\n\r\n<p> “Who dah?”\r\n</p>\r\n\r\n<p> He listened some more; then he come tiptoeing down and stood right between\r\nus; we could a touched him, nearly. Well, likely it was minutes and minutes that\r\nthere warn’t a sound, and we all there so close together. There was a place on\r\nmy ankle that got to itching, but I dasn’t scratch it; and then my ear begun to\r\nitch; and next my back, right between my shoulders. Seemed like I’d die if I\r\ncouldn’t scratch. Well, I’ve noticed that thing plenty times since. If you are with\r\nthe quality, or at a funeral, or trying to go to sleep when you ain’t sleepy—if you\r\nare anywheres where it won’t do for you to scratch, why you will itch all over in\r\nupwards of a thousand places. Pretty soon Jim says:\r\n</p>\r\n\r\n<p> “Say, who is you? Whar is you? Dog my cats ef I didn’ hear sumf’n. Well, I\r\nknow what I’s gwyne to do: I’s gwyne to set down here and listen tell I hears it\r\nagin.”</p>\r\n\r\n<p> So he set down on the ground betwixt me and Tom. He leaned his back up\r\nagainst a tree, and stretched his legs out till one of them most touched one of\r\nmine. My nose begun to itch. It itched till the tears come into my eyes. But I\r\ndasn’t scratch. Then it begun to itch on the inside. Next I got to itching\r\nunderneath. I didn’t know how I was going to set still. This miserableness went\r\non as much as six or seven minutes; but it seemed a sight longer than that. I was\r\nitching in eleven different places now. I reckoned I couldn’t stand it more’n a\r\nminute longer, but I set my teeth hard and got ready to try. Just then Jim begun\r\nto breathe heavy; next he begun to snore—and then I was pretty soon\r\ncomfortable again.\r\n</p>', '', '2023-11-12 16:24:10', '2023-10-23 19:06:44'),
(3, '1', '2', '<p>The widow she cried over me, and called me a poor lost lamb, and she called\r\nme a lot of other names, too, but she never meant no harm by it. She put me in\r\nthem new clothes again, and I couldn’t do nothing but sweat and sweat, and feel\r\nall cramped up. Well, then, the old thing commenced again. The widow rung a\r\nbell for supper, and you had to come to time. When you got to the table you\r\ncouldn’t go right to eating, but you had to wait for the widow to tuck down her\r\nhead and grumble a little over the victuals, though there warn’t really anything\r\nthe matter with them,—that is, nothing only everything was cooked by itself. In\r\na barrel of odds and ends it is different; things get mixed up, and the juice kind\r\nof swaps around, and the things go better.</p>\r\n<p> After supper she got out her book and learned me about Moses and the\r\nBulrushers, and I was in a sweat to find out all about him; but by and by she let it\r\nout that Moses had been dead a considerable long time; so then I didn’t care no\r\nmore about him, because I don’t take no stock in dead people.\r\n</p>\r\n<p> Pretty soon I wanted to smoke, and asked the widow to let me. But she\r\nwouldn’t. She said it was a mean practice and wasn’t clean, and I must try to not\r\ndo it any more. That is just the way with some people. They get down on a\r\nthing when they don’t know nothing about it. Here she was a-bothering about\r\nMoses, which was no kin to her, and no use to anybody, being gone, you see, yet\r\nfinding a power of fault with me for doing a thing that had some good in it. And\r\nshe took snuff, too; of course that was all right, because she done it herself.</p>', 'She said it was a mean practice and wasn’t clean, and I must try to not do it any more.', '2023-11-15 17:38:15', '2023-11-15 17:38:15'),
(4, '1', '3', '<p> Her sister, Miss Watson, a tolerable slim old maid, with goggles on, had just\r\ncome to live with her, and took a set at me now with a spelling-book. She\r\nworked me middling hard for about an hour, and then the widow made her ease\r\nup. I couldn’t stood it much longer. Then for an hour it was deadly dull, and I\r\nwas fidgety. Miss Watson would say, “Don’t put your feet up there,\r\nHuckleberry;” and “Don’t scrunch up like that, Huckleberry—set up straight;”\r\nand pretty soon she would say, “Don’t gap and stretch like that, Huckleberry—\r\nwhy don’t you try to behave?” Then she told me all about the bad place, and I\r\nsaid I wished I was there. She got mad then, but I didn’t mean no harm. All I\r\nwanted was to go somewheres; all I wanted was a change, I warn’t particular. </P>\r\n\r\n<p> She said it was wicked to say what I said; said she wouldn’t say it for the whole\r\nworld; she was going to live so as to go to the good place. Well, I couldn’t see\r\nno advantage in going where she was going, so I made up my mind I wouldn’t\r\ntry for it. But I never said so, because it would only make trouble, and wouldn’t\r\ndo no good.\r\n</p>\r\n\r\n<p> Now she had got a start, and she went on and told me all about the good place.\r\nShe said all a body would have to do there was to go around all day long with a\r\nharp and sing, forever and ever. So I didn’t think much of it. But I never said so.\r\nI asked her if she reckoned Tom Sawyer would go there, and she said not by a\r\nconsiderable sight. I was glad about that, because I wanted him and me to be\r\ntogether </p>\r\n\r\n<p> Miss Watson she kept pecking at me, and it got tiresome and lonesome. By\r\nand by they fetched the niggers in and had prayers, and then everybody was off\r\nto bed. I went up to my room with a piece of candle, and put it on the table.\r\n</p>', NULL, '2023-11-12 18:11:54', '2023-11-12 18:11:54'),
(5, '4', '1', '<p> WELL, I got a good going-over in the morning from old Miss Watson on\r\naccount of my clothes; but the widow she didn’t scold, but only cleaned off the\r\ngrease and clay, and looked so sorry that I thought I would behave awhile if I\r\ncould. Then Miss Watson she took me in the closet and prayed, but nothing\r\ncome of it. She told me to pray every day, and whatever I asked for I would get\r\nit. But it warn’t so. I tried it. Once I got a fish-line, but no hooks. It warn’t any\r\ngood to me without hooks. I tried for the hooks three or four times, but\r\nsomehow I couldn’t make it work. By and by, one day, I asked Miss Watson to\r\ntry for me, but she said I was a fool. She never told me why, and I couldn’t\r\nmake it out no way.\r\n</p>\r\n<p> I set down one time back in the woods, and had a long think about it. I says to\r\nmyself, if a body can get anything they pray for, why don’t Deacon Winn get\r\nback the money he lost on pork? Why can’t the widow get back her silver\r\nsnuffbox that was stole? Why can’t Miss Watson fat up? No, says I to my self,\r\nthere ain’t nothing in it. I went and told the widow about it, and she said the\r\nthing a body could get by praying for it was “spiritual gifts.” This was too many\r\nfor me, but she told me what she meant—I must help other people, and do\r\neverything I could for other people, and look out for them all the time, and never\r\nthink about myself. This was including Miss Watson, as I took it. I went out in\r\nthe woods and turned it over in my mind a long time, but I couldn’t see no\r\nadvantage about it—except for the other people; so at last I reckoned I wouldn’t\r\nworry about it any more, but just let it go. Sometimes the widow would take me\r\none side and talk about Providence in a way to make a body’s mouth water; but\r\nmaybe next day Miss Watson would take hold and knock it all down again. I\r\njudged I could see that there was two Providences, and a poor chap would stand\r\nconsiderable show with the widow’s Providence, but if Miss Watson’s got him\r\nthere warn’t no help for him any more. I thought it all out, and reckoned I would\r\nbelong to the widow’s if he wanted me, though I couldn’t make out how he was\r\na-going to be any better off then than what he was before, seeing I was so\r\nignorant, and so kind of low-down and ornery.\r\n</p>\r\n<p> Pap he hadn’t been seen for more than a year, and that was comfortable for\r\nme; I didn’t want to see him no more. He used to always whale me when he was\r\nsober and could get his hands on me; though I used to take to the woods most of\r\nthe time when he was around. Well, about this time he was found in the river\r\ndrownded, about twelve mile above town, so people said. They judged it was\r\nhim, anyway; said this drownded man was just his size, and was ragged, and had\r\nuncommon long hair, which was all like pap; but they couldn’t make nothing out\r\nof the face, because it had been in the water so long it warn’t much like a face at\r\nall. They said he was floating on his back in the water. They took him and\r\nburied him on the bank. But I warn’t comfortable long, because I happened to\r\nthink of something. I knowed mighty well that a drownded man don’t float on\r\nhis back, but on his face. So I knowed, then, that this warn’t pap, but a woman\r\ndressed up in a man’s clothes. So I was uncomfortable again. I judged the old\r\nman would turn up again by and by, though I wished he wouldn’t.\r\n</p>\r\n<p> man would turn up again by and by, though I wished he wouldn’t.\r\nWe played robber now and then about a month, and then I resigned. All the\r\nboys did. We hadn’t robbed nobody, hadn’t killed any people, but only just\r\npretended. We used to hop out of the woods and go charging down on hogdrivers and women in carts taking garden stuff to market, but we never hived any\r\nof them. Tom Sawyer called the hogs “ingots,” and he called the turnips and\r\nstuff “julery,” and we would go to the cave and powwow over what we had\r\ndone, and how many people we had killed and marked. But I couldn’t see no\r\nprofit in it. One time Tom sent a boy to run about town with a blazing stick,\r\nwhich he called a slogan (which was the sign for the Gang to get together), and\r\nthen he said he had got secret news by his spies that next day a whole parcel of\r\nSpanish merchants and rich A-rabs was going to camp in Cave Hollow with two\r\nhundred elephants, and six hundred camels, and over a thousand “sumter” mules,\r\nall loaded down with di’monds, and they didn’t have only a guard of four\r\nhundred soldiers, and so we would lay in ambuscade, as he called it, and kill the\r\nlot and scoop the things. He said we must slick up our swords and guns, and get\r\nready. He never could go after even a turnip-cart but he must have the swords\r\nand guns all scoured up for it, though they was only lath and broomsticks, and\r\nyou might scour at them till you rotted, and then they warn’t worth a mouthful of\r\nashes more than what they was before. I didn’t believe we could lick such a\r\ncrowd of Spaniards and A-rabs, but I wanted to see the camels and elephants, so\r\nI was on hand next day, Saturday, in the ambuscade; and when we got the word\r\nwe rushed out of the woods and down the hill. But there warn’t no Spaniards\r\nand A-rabs, and there warn’t no camels nor no elephants. It warn’t anything but\r\na Sunday-school picnic, and only a primer-class at that. We busted it up, and\r\nchased the children up the hollow; but we never got anything but some\r\ndoughnuts and jam, though Ben Rogers got a rag doll, and Jo Harper got a\r\nhymn-book and a tract; and then the teacher charged in, and made us drop\r\neverything and cut.</p>', NULL, '2023-11-13 18:02:18', '2023-11-13 18:02:18'),
(6, '3', '2', '<p> Tom he made a sign to me—kind of a little noise with his mouth—and we\r\nwent creeping away on our hands and knees. When we was ten foot off Tom\r\nwhispered to me, and wanted to tie Jim to the tree for fun. But I said no; he\r\nmight wake and make a disturbance, and then they’d find out I warn’t in. Then\r\nTom said he hadn’t got candles enough, and he would slip in the kitchen and get\r\nsome more. I didn’t want him to try. I said Jim might wake up and come. But\r\nTom wanted to resk it; so we slid in there and got three candles, and Tom laid\r\nfive cents on the table for pay. Then we got out, and I was in a sweat to get\r\naway; but nothing would do Tom but he must crawl to where Jim was, on his\r\nhands and knees, and play something on him. I waited, and it seemed a good\r\nwhile, everything was so still and lonesome.\r\n</p>\r\n<p> As soon as Tom was back we cut along the path, around the garden fence, and\r\nby and by fetched up on the steep top of the hill the other side of the house. Tom\r\nsaid he slipped Jim’s hat off of his head and hung it on a limb right over him, and\r\nJim stirred a little, but he didn’t wake. Afterwards Jim said the witches be\r\nwitched him and put him in a trance, and rode him all over the State, and then set\r\nhim under the trees again, and hung his hat on a limb to show who done it. And\r\nnext time Jim told it he said they rode him down to New Orleans; and, after that,\r\nevery time he told it he spread it more and more, till by and by he said they rode\r\nhim all over the world, and tired him most to death, and his back was all over\r\nsaddle-boils. Jim was monstrous proud about it, and he got so he wouldn’t\r\nhardly notice the other niggers. Niggers would come miles to hear Jim tell about\r\nit, and he was more looked up to than any nigger in that country. Strange\r\nniggers would stand with their mouths open and look him all over, same as if he\r\nwas a wonder. Niggers is always talking about witches in the dark by the\r\nkitchen fire; but whenever one was talking and letting on to know all about such\r\nthings, Jim would happen in and say, “Hm! What you know ’bout witches?” and\r\nthat nigger was corked up and had to take a back seat. Jim always kept that fivecenter piece round his neck with a string, and said it was a charm the devil give\r\nto him with his own hands, and told him he could cure anybody with it and fetch\r\nwitches whenever he wanted to just by saying something to it; but he never told\r\nwhat it was he said to it. Niggers would come from all around there and give\r\nJim anything they had, just for a sight of that five-center piece; but they wouldn’t\r\ntouch it, because the devil had had his hands on it. Jim was most ruined for a\r\nservant, because he got stuck up on account of having seen the devil and been\r\nrode by witches.\r\n</p>\r\n<p> Well, when Tom and me got to the edge of the hilltop we looked away down\r\ninto the village and could see three or four lights twinkling, where there was sick\r\nfolks, maybe; and the stars over us was sparkling ever so fine; and down by the\r\nvillage was the river, a whole mile broad, and awful still and grand. We went\r\ndown the hill and found Jo Harper and Ben Rogers, and two or three more of the\r\nboys, hid in the old tanyard. So we unhitched a skiff and pulled down the river\r\ntwo mile and a half, to the big scar on the hillside, and went ashore.\r\n</p>\r\n<p> We went to a clump of bushes, and Tom made everybody swear to keep the\r\nsecret, and then showed them a hole in the hill, right in the thickest part of the\r\nbushes. Then we lit the candles, and crawled in on our hands and knees. We\r\nwent about two hundred yards, and then the cave opened up. Tom poked about\r\namongst the passages, and pretty soon ducked under a wall where you wouldn’t\r\na noticed that there was a hole. We went along a narrow place and got into a\r\nkind of room, all damp and sweaty and cold, and there we stopped. Tom says:\r\n</p>\r\n<p> “Now, we’ll start this band of robbers and call it Tom Sawyer’s Gang.\r\nEverybody that wants to join has got to take an oath, and write his name in\r\nblood.”</p>', '', '2023-11-12 16:26:05', '2023-09-11 12:45:39'),
(7, '4', '2', '<p>I didn’t see no di’monds, and I told Tom Sawyer so. He said there was loads\r\nof them there, anyway; and he said there was A-rabs there, too, and elephants\r\nand things. I said, why couldn’t we see them, then? He said if I warn’t so\r\nignorant, but had read a book called Don Quixote, I would know without asking.\r\nHe said it was all done by enchantment. He said there was hundreds of soldiers\r\nthere, and elephants and treasure, and so on, but we had enemies which he called\r\nmagicians; and they had turned the whole thing into an infant Sunday-school,\r\njust out of spite. I said, all right; then the thing for us to do was to go for the\r\nmagicians. Tom Sawyer said I was a numskull.</p>\r\n\r\n<p>“Why,” said he, “a magician could call up a lot of genies, and they would hash\r\nyou up like nothing before you could say Jack Robinson. They are as tall as a\r\ntree and as big around as a church.”</p>\r\n\r\n<p>“Well,” I says, “s’pose we got some genies to help us—can’t we lick the other\r\ncrowd then?”</p>\r\n\r\n<p>“How you going to get them?”</p>\r\n\r\n<p>“I don’t know. How do they get them?”</p>\r\n\r\n<p>“Why, they rub an old tin lamp or an iron ring, and then the genies come\r\ntearing in, with the thunder and lightning a-ripping around and the smoke arolling, and everything they’re told to do they up and do it. They don’t think\r\nnothing of pulling a shot-tower up by the roots, and belting a Sunday-school\r\nsuperintendent over the head with it—or any other man.”</p>\r\n\r\n<p>“Who makes them tear around so?”</p>\r\n\r\n<p>“Why, whoever rubs the lamp or the ring. They belong to whoever rubs the\r\nlamp or the ring, and they’ve got to do whatever he says. If he tells them to\r\nbuild a palace forty miles long out of di’monds, and fill it full of chewing-gum,\r\nor whatever you want, and fetch an emperor’s daughter from China for you to\r\nmarry, they’ve got to do it—and they’ve got to do it before sun-up next morning,\r\ntoo. And more: they’ve got to waltz that palace around over the country\r\nwherever you want it, you understand.”</p>\r\n\r\n<p>“Well,” says I, “I think they are a pack of flat-heads for not keeping the palace</p>\r\nthemselves ’stead of fooling them away like that. And what’s more—if I was\r\none of them I would see a man in Jericho before I would drop my business and\r\ncome to him for the rubbing of an old tin lamp.”</p>\r\n\r\n<p>“How you talk, Huck Finn. Why, you’d have to come when he rubbed it,\r\nwhether you wanted to or not.”</p>\r\n\r\n<p>“What! and I as high as a tree and as big as a church? All right, then; I would\r\ncome; but I lay I’d make that man climb the highest tree there was in the\r\ncountry.”</p>\r\n\r\n<p>“Shucks, it ain’t no use to talk to you, Huck Finn. You don’t seem to know\r\nanything, somehow—perfect saphead.”</p>\r\n\r\n<p>I thought all this over for two or three days, and then I reckoned I would see if\r\nthere was anything in it. I got an old tin lamp and an iron ring, and went out in\r\nthe woods and rubbed and rubbed till I sweat like an Injun, calculating to build a\r\npalace and sell it; but it warn’t no use, none of the genies come. So then I\r\njudged that all that stuff was only just one of Tom Sawyer’s lies. I reckoned he\r\nbelieved in the A-rabs and the elephants, but as for me I think different. It had\r\nall the marks of a Sunday-school.</p>\r\n\r\n', '', '2023-11-12 16:32:29', '2023-09-11 12:46:01'),
(8, '6', '1', 'qedasdfsafafdafadf', NULL, '2023-11-12 09:15:43', '2023-11-12 16:15:43'),
(9, '1', '4', '<p> Then I set down in a chair by the window and tried to think of something\r\ncheerful, but it warn’t no use. I felt so lonesome I most wished I was dead. The\r\nstars were shining, and the leaves rustled in the woods ever so mournful; and I\r\nheard an owl, away off, who-whooing about somebody that was dead, and a\r\nwhippowill and a dog crying about somebody that was going to die; and the\r\nwind was trying to whisper something to me, and I couldn’t make out what it\r\nwas, and so it made the cold shivers run over me. Then away out in the woods I\r\nheard that kind of a sound that a ghost makes when it wants to tell about\r\nsomething that’s on its mind and can’t make itself understood, and so can’t rest\r\neasy in its grave, and has to go about that way every night grieving. I got so\r\ndown-hearted and scared I did wish I had some company. Pretty soon a spider\r\nwent crawling up my shoulder, and I flipped it off and it lit in the candle; and\r\nbefore I could budge it was all shriveled up. I didn’t need anybody to tell me\r\nthat that was an awful bad sign and would fetch me some bad luck, so I was\r\nscared and most shook the clothes off of me. I got up and turned around in my\r\ntracks three times and crossed my breast every time; and then I tied up a little\r\nlock of my hair with a thread to keep witches away. But I hadn’t no confidence. </p>\r\n\r\n<p> You do that when you’ve lost a horseshoe that you’ve found, instead of nailing\r\nit up over the door, but I hadn’t ever heard anybody say it was any way to keep\r\noff bad luck when you’d killed a spider.\r\n</p>\r\n\r\n<p> I set down again, a-shaking all over, and got out my pipe for a smoke; for the\r\nhouse was all as still as death now, and so the widow wouldn’t know. Well, after\r\na long time I heard the clock away off in the town go boom—boom—boom—\r\ntwelve licks; and all still again—stiller than ever. Pretty soon I heard a twig snap\r\ndown in the dark amongst the trees—something was a stirring. I set still and\r\nlistened. Directly I could just barely hear a “me-yow! me-yow!” down there.\r\nThat was good! Says I, “me-yow! me-yow!” as soft as I could, and then I put\r\nout the light and scrambled out of the window on to the shed. Then I slipped\r\ndown to the ground and crawled in among the trees, and, sure enough, there was\r\nTom Sawyer waiting for me.\r\n</p>', 'Then I set down in a chair by the win', '2023-11-13 17:47:49', '2023-11-13 17:47:49'),
(10, '1', '5', '<p>asdasdasdsadsadasdas</p>\r\n<p>asdsadsadsadasdsa</p>', NULL, '2023-11-25 05:14:06', '2023-11-25 12:14:06'),
(11, '6', '2', '<div>\r\n<div>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nisi, incidunt soluta necessitatibus placeat voluptatibus aut inventore repellendus delectus error doloremque quibusdam magnam esse voluptate porro a distinctio dicta et sint?</div>\r\n<div>&nbsp;</div>\r\n<div>\r\n<div>\r\n<div>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nisi, incidunt soluta necessitatibus placeat voluptatibus aut inventore repellendus delectus error doloremque quibusdam magnam esse voluptate porro a distinctio dicta et sint?</div>\r\n</div>\r\n</div>\r\n</div>', NULL, '2023-11-28 12:35:16', '2023-11-28 19:35:16'),
(12, '1', '6', '<p><img style=\"display: block; margin-left: auto; margin-right: auto;\" src=\"/gambar/1701455887.jpg\" alt=\"\" width=\"138\" height=\"172\" /></p>\r\n<div>\r\n<div style=\"text-align: justify;\">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ab, inventore odio doloremque voluptatum repellat dolores animi molestiae provident aut unde voluptas rem sint, corporis corrupti illum quis saepe incidunt vero!Lorem ipsum dolor sit amet consectetur adipisicing elit. Ab, inventore odio doloremque voluptatum repellat dolores animi molestiae provident aut unde voluptas rem sint, corporis corrupti illum quis saepe incidunt vero!\r\n<div>\r\n<div style=\"text-align: justify;\">\r\n<div style=\"text-align: justify;\">&nbsp;</div>\r\n<div style=\"text-align: justify;\">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ab, inventore odio doloremque voluptatum repellat dolores animi molestiae provident aut unde voluptas rem sint, corporis corrupti illum quis saepe incidunt vero!Lorem ipsum dolor sit amet consectetur adipisicing elit. Ab, inventore odio doloremque voluptatum repellat dolores animi molestiae provident aut unde voluptas rem sint, corporis corrupti illum quis saepe incidunt vero!</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>', NULL, '2023-12-01 18:56:51', '2023-12-01 18:39:43');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `nama_user` varchar(255) NOT NULL,
  `email_user` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama_user`, `email_user`, `password`, `created_at`, `updated_at`) VALUES
(1, 'asd', 'asd@gmail.com', '$2y$10$FXleEn7f49JDB04ecSVWkO.EYBXqSqopoDhUf7KC4IS.44Aes9soi', '2023-11-08 09:36:24', '2023-11-08 16:36:24'),
(2, '123', '123@gmail.com', '$2y$10$20ygHrgKJRrXtUF7BPsaKeZsNGLIr3qakiSqJe3kwyNJGgDmQQhou', '2023-11-08 14:13:32', '2023-11-08 21:13:32');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chapters`
--
ALTER TABLE `chapters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `novels`
--
ALTER TABLE `novels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chapters`
--
ALTER TABLE `chapters`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `novels`
--
ALTER TABLE `novels`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
