function pregistry:ban(playername)
	pregistry.file:addban(playername)
	pregistry.api:registerban(playername)

	minetest.kick(playername, "Banned from the land.")

	return "Banned "..playername
end

function pregistry:unregister(playername)
	-- TODO run challenge routine on unregistered player
end

function pregistry:unban(playername)
	pregistry.file:removeban(playername)
	pregistry.api:unregisterban(playername)

	return "Unbanned "..playername
end

function pregistry:isbanned(args)
	local servername = args[1]
	local playername = args[2]
	local syncmode = args[3]

	local response = pregistry.api:querystatus(playername) -- FIXME need to specify a server name

	-- FIXME this is old code based on a previous spec
	-- the current function should just return status
	if response.known then
		if response.banned then
			if syncmode == 'sync' then
				pregistry:ban(playername)
				return 'Banned '..playername

			else
				return playername.." is *banned* on "..servername

			end
		else
			return playername.." is allowed on "..servername

		end
	else
		return playername..' is not known on '..servername

	end
end
