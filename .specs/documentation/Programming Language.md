The original statement is as follows:
```
We want to build a small Logger library in the programming language of our choice. This will be a library used by other development teams in the company, so we need to build it as such and it needs to be generic and open enough.
```

Now the issue in this statement is the `programming language of our choice` part. I imagine this is intended to give the liberty of choosing between Java or PHP (I wouldn't use either for this specific task) because of two reasons: 
1. Further down the task specification, it is mentioned that some configurations can be adjusted during [[Runtime|runtime]];
2. It is requested that we take into account [[Multi-threading|multi-threading and race/concurrency issues]];

We will decide the programming language of our choice is PHP to stick to the role we have applied for with the stretched definitions of [[Runtime|runtime]] and [[Multi-threading|concurrency]]. (But we might have some fun with other programming languages off-record, just to see how it goes).